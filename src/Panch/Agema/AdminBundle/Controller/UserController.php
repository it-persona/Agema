<?php

namespace Panch\Agema\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    /**
     * @Route("/admin/users/list")
     * @Template()
     */
    public function listAction()
    {
        $users = $this->get('fos_user.user_manager')->findUsers();

        return [
                'page_title' => 'Users List',
                'users'      => $users
        ];
    }

    /**
     * @Route("/admin/users/add")
     * @Template()
     */
    public function addAction()
    {
        return [
                'msg' => 'userAddAction'
        ];
    }
}
