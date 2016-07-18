<?php


namespace CrawlerUtils;

/**
 * Class AbstractParser
 * @package common\components\crawler\utils\parsers
 */
abstract class AbstractParser
{
    /**
     * @var \DOMDocument
     */
    protected $dom;
    /**
     * @var
     */
    protected $xpath;

    /**
     * HtmlParser constructor.
     * @param $html
     */
    public function __construct($html)
    {
        $this->dom = new \DOMDocument();
        //todo research problem with html5 tag
        libxml_use_internal_errors(true);
        $this->dom->loadHTML($html);
        //todo research problem with html5 tag
        libxml_clear_errors();
    }

    /**
     * @param $expression
     * @return \DOMNodeList
     */
    public function getNodesByExpression($expression)
    {
        $this->xpath = new \DOMXPath($this->dom);
        $nodes = $this->xpath->query($expression);
        
        return $nodes;
    }
}