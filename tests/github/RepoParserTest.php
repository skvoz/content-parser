<?php

namespace CrawlerUtils\tests;

use CrawlerUtils\github\RepoParser;
use PHPUnit_Framework_TestCase;

class RepoParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $dataFalse;

    public function setUp()
    {
        $path = __DIR__ . '/data/repo.html';
        $this->data = file_get_contents($path);
        $pathFalse = __DIR__ . '/data/repoFalse.html';
        $this->dataFalse = file_get_contents($pathFalse);
    }

    public function testGetStars()
    {
        $parser = new RepoParser($this->data);
        $stars = $parser->getStars();
        
        $this->assertEquals($stars, '1095');
    }

    public function testGetLanguages()
    {
        $parser = new RepoParser($this->data);
        $languages = $parser->getLanguages();
        $array = [
            ['lang' => 'PHP', 'percent' => '97.6%'],
            ['lang' => 'HTML', 'percent' => '2.2%'],
            ['lang' => 'CSS', 'percent' => '0.1%'],
            ['lang' => 'C', 'percent' => '0.1%'],
            ['lang' => 'M4', 'percent' => '0.0%'],
            ['lang' => 'Shell', 'percent' => '0.0%'],
        ];

        $this->assertEquals($array, $languages);
    }


    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetStartError()
    {
        $parser = new RepoParser($this->dataFalse);
        $parser->getStars();
    }

    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetLanguagesFalse()
    {
        $parser = new RepoParser($this->dataFalse);
        $parser->getLanguages();
    }
}