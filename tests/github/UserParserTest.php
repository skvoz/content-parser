<?php

namespace CrawlerUtils\tests;

use CrawlerUtils\github\UserParser;
use PHPUnit_Framework_TestCase;

class UserParserTest extends \PHPUnit_Framework_TestCase
{
    private $data;
    private $dataFalse;

    public function setUp()
    {
        $path = __DIR__ . '/data/user.html';
        $this->data = file_get_contents($path);

        $pathFalse = __DIR__ . '/data/userFalse.html';
        $this->dataFalse = file_get_contents($pathFalse);
    }

    public function testGetEmail()
    {
        $parser = new UserParser($this->data);
        $email = $parser->getEmail();

        $this->assertEquals($email, 'fabien@symfony.com');
    }

    public function testGetOrganization()
    {
        $parser = new UserParser($this->data);
        $organization = $parser->getOrganization();

        $this->assertEquals($organization, 'SensioLabs');
    }

    public function testGetLocation()
    {
        $parser = new UserParser($this->data);
        $location = $parser->getLocation();

        $this->assertEquals($location, 'Paris, France');
    }

    public function testGetWeb()
    {
        $parser = new UserParser($this->data);
        $web = $parser->getWeb();

        $this->assertEquals($web, 'http://fabien.potencier.org/');
    }

    public function testGetOrganizations()
    {
        $testArr = [
            'swiftmailer',
            'sensio',
            'symfony',
            'doctrine',
            'sensiolabs',
            'silexphp',
            'FriendsOfPHP',
            'blackfireio',
        ];
        $parser = new UserParser($this->data);

        $organizations = $parser->getOrganizations();

        $this->assertEquals($testArr, $organizations);
    }

    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetEmailFalse()
    {
        $parser = new UserParser($this->dataFalse);
        $parser->getEmail();
    }
    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetOrganizationFalse()
    {
        $parser = new UserParser($this->dataFalse);
        $parser->getOrganization();
    }
    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetLocationFalse()
    {
        $parser = new UserParser($this->dataFalse);
        $parser->getLocation();
    }
    /**
     * @expectedException CrawlerUtils\exception\DOMParsingException
     */
    public function testGetWebFalse()
    {
        $parser = new UserParser($this->dataFalse);
        $parser->getWeb();
    }

    public function testGetOrganizationsFalse()
    {
        $parser = new UserParser($this->dataFalse);
        $organizations = $parser->getOrganizations();

        $this->assertEquals($organizations, []);
    }
}