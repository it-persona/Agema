<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testErrorDashAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');
        $this->assertNotEquals(404, $client->getResponse()->getStatusCode());
    }
}
