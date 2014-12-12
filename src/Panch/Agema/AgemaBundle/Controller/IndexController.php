<?php

namespace Panch\Agema\AgemaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var string
     */
    protected $siteName;

    /**
     * @var string
     */
    protected $pageTitle;

    public function __construct()
    {
        // TODO: Add entity for site & page options. Return array of options properties from database.
        $this->siteName = 'Agema Optics';
        $this->pageTitle = 'Homepage';
    }

    /**
     * @Template()
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {

        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $role = $user->getRoles();

            if (empty($role)) {
                $user->setRoles(array('ROLE_DEFAULT'));
                $this->get('fos_user.user_manager')->updateUser($user, true);
                $role = $user->getRoles();
            }

            return ['user_roles' => $role];
        }

        return[$this->get('router')->generate('panch_agema_agema_index_index')];
    }
}
