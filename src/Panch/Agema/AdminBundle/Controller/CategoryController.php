<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Panch\Agema\AgemaBundle\Entity\Category;
use Panch\Agema\AgemaBundle\Entity\Product;

class CategoryController extends Controller
{
    /**
     * Get list all categories
     *
     * @Template()
     * @Route("/admin/categories/list")
     * @Method("GET")
     *
     * @return array    Categories and more
     */
    public function listAction()
    {
        return [
                'title'      => 'Categories',
                'categories' => $this->getDoctrine()->getRepository('PanchAgemaBundle:Category')->findAll()
        ];
    }

    /**
     * Add new category
     *
     * @Template()
     * @Route("/admin/categories/add")
     * @Method("GET")
     *
     * @return array Demo data
     */
    public function addAction()
    {
        return [
                'title'   => 'Add Category',
                'message' => 'This work!'
        ];
    }
}
