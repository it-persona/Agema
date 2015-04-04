<?php

namespace Panch\Agema\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListUsers()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/products/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
