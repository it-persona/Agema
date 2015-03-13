<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    /**
     * This method render Users list
     *
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
     * This method render and validating data of Form Adding new User
     *
     * @Route("/admin/users/add")
     * @Template()
     */
    public function addAction()
    {
        return [
                'msg' => 'userAddAction'
        ];
    }

    /**
     * This method delete User by Username
     *
     * @Route("/admin/user/delete/{userName}")
     * @Method("GET")
     *
     * @param $userName
     * @return Route
     */
    public function deleteAction($userName)
    {
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $userName));
        $this->get('fos_user.user_manager')->deleteUser($user);

        return $this->redirect($this->generateUrl('panch_agema_admin_user_list'));
    }

    /**
     * This method for lock or unlock User by Username
     *
     * @Route("/admin/user/lock/{userName}={lock}")
     * @Method("GET")
     *
     * @param $userName
     * @param boolean $lock
     * @return Route
     */
    public function lockAction($userName, $lock)
    {
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $userName));
        $user->setLocked($lock);

        $this->get('fos_user.user_manager')->updateUser($user);

        return $this->redirect($this->generateUrl('panch_agema_admin_user_list'));
    }
}
