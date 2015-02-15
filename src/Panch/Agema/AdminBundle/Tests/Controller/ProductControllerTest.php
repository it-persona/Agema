<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testErrorAddAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/add');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }


    public function testErrorListAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/product/list');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
