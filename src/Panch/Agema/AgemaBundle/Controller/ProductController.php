<?php

namespace Panch\Agema\AgemaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * This method render Product by Slug
     *
     * @Template()
     * @Route("/product/{slug}")
     * @Method("GET")
     *
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {
        return ['product' => $this->get('doctrine')->getManager()->getRepository('PanchAgemaBundle:Product')->findOneBySlug($slug)];
    }
}
