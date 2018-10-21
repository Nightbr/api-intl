<?php

use Liip\FunctionalTestBundle\Test\WebTestCase;

class IntlBooksTest extends WebTestCase
{

    public function setUp() 
    {
        $this->loadFixtures(array(
            'App\DataFixtures\AppFixtures'
        ));
    }

    public function testBookWithLocale()
    {
        $client = $this->createClient();
        $client->request('GET', '/api/books',
        array(),
        array(),
        array(
            'HTTP_X-LOCALE' => 'fr',
            'HTTP_Accept' => 'application/ld+json'
        ));
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertStatusCode(200, $client);
        $this->assertEquals('Livre FR 0', $data['hydra:member'][0]['title']);


        $client->request('GET', '/api/books/1',
        array(),
        array(),
        array(
            'HTTP_X-LOCALE' => 'fr',
            'HTTP_Accept' => 'application/ld+json'
        ));
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertStatusCode(200, $client);
        $this->assertEquals('Livre FR 0', $data['title']);

       
    }
}