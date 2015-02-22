<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class DashController extends Controller
{
    /**
     * This method render Admin Dashboard (Front Controller)
     *
     * @Template()
     * @Route("/admin")
     * @Method("GET")
     *
     * @return array
     */
    public function dashAction()
    {
        return [
                'page_title'    => 'Dashboard',
        ];
    }
}
