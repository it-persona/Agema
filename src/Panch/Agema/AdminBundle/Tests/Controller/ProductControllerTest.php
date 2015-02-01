<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testAddAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/add');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testErrorAddAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/add');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testListAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testErrorListAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/list');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
