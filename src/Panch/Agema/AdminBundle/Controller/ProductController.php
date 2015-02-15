<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Panch\Agema\AgemaBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Template()
     * @Route("/admin/products/add")
     * @Method("GET")
     */
    public function addAction()
    {
        return [
                'test'    => 'Action -ADD- work!',
                'title'   => 'New Product',
        ];
    }

    /**
     * @Template()
     * @Route("/admin/products/list")
     * @Method("GET")
     */
    public function listAction()
    {
        return [
                'test'     => 'Action ListProducts - OK!',
                'title'    => 'Products List',
        ];
    }
}
