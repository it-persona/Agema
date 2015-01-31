<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{

    /**
     * @Template()
     * @Route("/dashboard")
     * @Method("GET")
     */

    public function indexAction()
    {
        return ['message' => 'It work!'];
    }
}
