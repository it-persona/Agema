<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testErrorListAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/categories/list');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testErrorAddAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/categories/add');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
