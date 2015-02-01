<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testErrorIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
