<?php

namespace Panch\Agema\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/admin/users/list');
        $response = $client->getResponse();

        if ($response->getStatusCode() == 302)
        {
            $this->markTestSkipped();
        }

        $this->assertEquals($response->getStatusCode(), 400);
    }

    public function testNotEmptyUsersList()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $users = $kernel->getContainer()->get('fos_user.user_manager')->findUsers();

        $this->assertNotEmpty($users);
    }
}
