<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class DashController extends Controller
{
    /**
     * @Template()
     * @Route("/admin")
     * @Method("GET")
     */
    public function dashAction()
    {
        return [
                'title'    => 'Dashboard',
                'message'  => 'It work!',
        ];
    }
}
