<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
    public function doLogin($username, $password) {
	   $crawler = $this->client->request('GET', '/login');
	   $form = $crawler->selectButton('_submit')->form(array(
	       '_username'  => $username,
	       '_password'  => $password,
	       ));     
	   $this->client->submit($form);

	   $this->assertTrue($this->client->getResponse()->isRedirect());

	   $crawler = $this->client->followRedirect();
	}
}
