<?php


namespace CrawlerUtils\github;

use CrawlerUtils\AbstractParser;
use CrawlerUtils\exception\DOMParsingException;
use DOMNodeList;

/**
 * Class UserParser
 * @package CrawlerUtils\src\github
 */
class UserParser extends AbstractParser
{
    /**
     * @var string
     */
    protected $queryEmail = '//li[@aria-label="Email"]/a';
    /**
     * @var string
     */
    protected $queryOrganization = '//li[@aria-label="Organization"]/div';
    /**
     * @var string
     */
    protected $queryLocation = '//li[@aria-label="Home location"]';
    /**
     * @var string
     */
    protected $queryWeb = '//li[@aria-label="Blog or website"]/a';
    /**
     * @var string
     */
    protected $queryOrganizations = '//*[@class="clearfix"]//@aria-label';

    /**
     * @return \DOMNodeList
     * @throws DOMParsingException
     */
    public function getEmail()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryEmail);
        
        if ($nodes->length > 0) {

            return trim($nodes->item(0)->nodeValue);
        }

        throw new DOMParsingException('Trouble with parsing count stars from repo page');
    }

    /**
     * @return DOMNodeList
     * @throws DOMParsingException
     */
    public function getOrganization()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryOrganization);

        if ($nodes->length > 0) {

            return trim($nodes->item(0)->nodeValue);
        }

        throw new DOMParsingException('Trouble with parsing count stars from repo page');
    }

    /**
     * @return DOMNodeList
     * @throws DOMParsingException
     */
    public function getLocation()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryLocation);

        if ($nodes->length > 0) {

            return trim($nodes->item(0)->nodeValue);
        }

        throw new DOMParsingException('Trouble with parsing count stars from repo page');
    }

    /**
     * @return DOMNodeList
     * @throws DOMParsingException
     */
    public function getWeb()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryWeb);

        if ($nodes->length > 0) {

            return trim($nodes->item(0)->nodeValue);
        }

        throw new DOMParsingException('Trouble with parsing count stars from repo page');
    }

    public function getOrganizations()
    {
        /** @var DOMNodeList $nodes */
        $nodes = $this->getNodesByExpression($this->queryOrganizations);
        $arrOrganizations = [];
        
        foreach ($nodes as $item) {
            $arrOrganizations[] = $item->nodeValue;
        }

        return $arrOrganizations;
    }
}