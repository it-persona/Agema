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
        $product = $this->getDoctrine()->getManager()->getRepository('PanchAgemaBundle:Product')->findOneBy(array('slug' => $slug));

        if (!$product == true || is_null($product->getDeletedAt()) == false) {
            throw $this->createNotFoundException('Opps! This product does not exist.');
        }

        return [
                'product' => $product
        ];
    }
}
