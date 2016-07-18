<?php


namespace CrawlerUtils\github;
use CrawlerUtils\AbstractParser;
use CrawlerUtils\exception\DOMParsingException;
use DOMNodeList;

/**
 * Class RepoParser
 * @package CrawlerUtils\src\github
 */
class RepoParser extends AbstractParser
{
    /**
     * @var string
     */
    protected $queryStars = '//*[@class="social-count js-social-count"]';
    /**
     * @var string
     */
    protected $queryLanguages = '//ol[@class="repository-lang-stats-numbers"]/li/a';

    /**
     * @return mixed
     * @throws DOMParsingException
     */
    public function getStars()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryStars);
        if ($nodes->length > 0) {

            return trim($string = preg_replace('/,/u', '', $nodes->item(0)->nodeValue));
        }

        throw new DOMParsingException('Trouble with parsing count stars from repo page');
    }

    /**
     * @return mixed
     * @throws DOMParsingException
     */
    public function getLanguages()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryLanguages);

        if ($nodes->length == 0)
            throw new DOMParsingException('Trouble with parsing count stars from repo page');
        
        $lang = [];
        foreach ($nodes as $node) {
            $listNodes = $node->getElementsByTagName('span');
            if ($listNodes->length > 0)
                $lang[] = [
                    'lang' => $listNodes->item(1)->nodeValue,
                    'percent' => $listNodes->item(2)->nodeValue,
                ];
        }

        return $lang;
    }
}