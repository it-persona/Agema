<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Panch\Agema\AdminBundle\Form\CategoryType;
use Panch\Agema\AgemaBundle\Entity\Category;

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
     * @Method(methods={"GET", "POST"})
     *
     * @param Request $request
     * @return array
     */
    public function addAction(Request $request)
    {
        $category = new Category();
        $errors = null;

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->get('doctrine.orm.entity_manager')->persist($category);
                $this->get('doctrine.orm.entity_manager')->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
            } else {
                $validator = $this->get('validator');
                $errors = $validator->validate($category);
            }
        }

        return [
                'page_title'    => 'Add Category',
                'form'          => $form->createView(),
                'errors'        => $errors
        ];
    }
}
