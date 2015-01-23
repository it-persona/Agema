<?php

namespace Panch\Agema\AgemaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Template()
     * @Route("/product/{slug}")
     * @Method("GET")
     */
    public function getAction($slug)
    {
        return ['product' => $this->get('doctrine')->getManager()->getRepository('PanchAgemaBundle:Product')->findOneBySlug($slug)];
    }

    /**
     * @Template()
     * @Route("/refractors/add")
     * @Method("GET")
     */
    public function addAction()
    {
        // In progress
       return ["test"    => "Action -ADD- work!"];
    }
}