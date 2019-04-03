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
    public function showAction($slug)
    {
        $product = $this->getDoctrine()->getManager()->getRepository('PanchAgemaBundle:Product')->findOneBy(array('slug' => $slug));

        if (!$product === true || $product->getDeletedAt() != null) {
            throw $this->createNotFoundException('Oops! This product does not exist.');
        }

        return [
                'product' => $product
        ];
    }

    /**
     * @Template()
     * @Route("/products/category/{slug}")
     * @Method("GET")
     *
     * @param $slug
     * @return array
     */
    public function listByCategoryAction($slug)
    {
        $category = $this->get('doctrine.orm.entity_manager')->getRepository('PanchAgemaBundle:Category')->findBy(array('slug' => $slug));
        $products = $this->get('doctrine.orm.entity_manager')->getRepository('PanchAgemaBundle:Product')->findBy(array('category' => $category));

        if ($products == null) {
            throw $this->createNotFoundException('Oops! No products on this category.');
        }

        return [ 'products' => $products ];
    }
}
