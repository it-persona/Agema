<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testErrorAddAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/products/add');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }


    public function testErrorListAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/products/list');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
