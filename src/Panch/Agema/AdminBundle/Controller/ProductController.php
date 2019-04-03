<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Panch\Agema\AdminBundle\Form\ProductType;
use Panch\Agema\AgemaBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * This method render and validating data of Form Adding new Product
     *
     * @Template()
     * @Route("/admin/products/add")
     * @Method(methods={"GET", "POST"})
     *
     * @param Request $request
     * @return array
     */
    public function addAction(Request $request)
    {
        $product = new Product();
        $errors = null;

        $form = $this->createForm(new ProductType(), $product);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->get('doctrine.orm.entity_manager')->persist($product);
                $this->get('doctrine.orm.entity_manager')->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_product_list'));
            } else {
                $validator = $this->get('validator');
                $errors = $validator->validate($product);
            }
        }

        return [
                'page_title'       => 'Add Product',
                'form'             => $form->createView(),
                'errors'           => $errors
        ];
    }

    /**
     * This method render Products list
     *
     * @Template()
     * @Route("/admin/products/list")
     * @Method("GET")
     *
     * @return array
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository('PanchAgemaBundle:Product')->findBy(array('deletedAt' => null));

        if ($this->isGranted('ROLE_ADMIN') === true)
        {
            $products = $this->getDoctrine()->getRepository('PanchAgemaBundle:Product')->findAll();
        }

        return [
                'page_title'       => 'Products List',
                'products'         => $products
        ];
    }

    /**
     * @Template()
     * @Route("/admin/products/update={slug}")
     * @Method(methods={"GET", "POST"})
     * @param Request $request
     * @param $slug
     * @param null $errors
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $slug, $errors = null)
    {
        $data = $this->getDoctrine()->getRepository('PanchAgemaBundle:Product')->findOneBy(array('slug' => $slug));

        $product = new Product();

        $form = $this->createForm(new ProductType(), $product);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->get('app_admin.services.data_manager')->updateObject($product, $data);
                $data->setThumbnail($product->getThumbnail());

                $this->get('doctrine.orm.entity_manager')->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_product_list'));
            }
            $errors = $this->get('validator')->validate($product);
        }

        return [
            'page_title'    => 'Edit Product',
            'product_data'  => $data,
            'form'          => $form->createView(),
            'errors'        => $errors
        ];
    }

    /**
     * This method soft-delete product by slug
     *
     * @Route("/admin/products/remove/{slug}")
     * @Method("GET")
     *
     * @param $slug
     * @return Route
     */
    public function removeAction($slug)
    {
            $product = $this->getDoctrine()->getManager()->getRepository('PanchAgemaBundle:Product')->findOneBy(array('slug' => $slug));

            if (!null == $product && $product->getSlug() == $slug) {
                $this->getDoctrine()->getManager()->remove($product);
                $this->getDoctrine()->getManager()->flush();
            }

        return $this->redirect($this->generateUrl('panch_agema_admin_product_list'));
    }
}
