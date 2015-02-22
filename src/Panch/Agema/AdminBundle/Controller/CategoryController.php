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
     * This method render Categories list
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
                'page_title'    => 'Categories List',
                'categories'    => $this->getDoctrine()->getRepository('PanchAgemaBundle:Category')->findAll()
        ];
    }

    /**
     * This method render and validating data of Form Adding new Category
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
                'page_title'    => 'Add Category',
                'message_test'  => 'This work!'
        ];
    }
}
