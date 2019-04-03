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
        $em = $this->get('doctrine.orm.entity_manager');
        $errors = null;

        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
            }
                $errors = $this->get('validator')->validate($category);
            }

        return [
                'page_title'    => 'Add Category',
                'form'          => $form->createView(),
                'errors'        => $errors
        ];
    }

    /**
     * @Template()
     * @Route("/admin/category/update={slug}")
     * @Method(methods={"GET", "POST"})
     *
     * @param Request $request
     * @param string $slug
     * @param null $errors
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $slug, $errors = null)
    {
        $data = $this->getDoctrine()->getRepository('PanchAgemaBundle:Category')->findOneBy(array('slug' => $slug));

        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->get('app_admin.services.data_manager')->updateObject($category, $data);
                $this->get('doctrine.orm.entity_manager')->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
            }
                $errors = $this->get('validator')->validate($category);
        }

        return [
                'page_title'    => 'Edit Category',
                'category_name' => $data->getName(),
                'form'          => $form->createView(),
                'errors'        => $errors
        ];
    }

    /**
     * This method delete category by slug
     *
     * @Route("/admin/category/remove/{slug}")
     * @Method("GET")
     *
     * @param string $slug
     * @return Route
     */
    public function removeAction($slug)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $category = $em->getRepository('PanchAgemaBundle:Category')->findOneBy(array('slug' => $slug));

        $this->container->get('app_admin.services.data_manager')->removeObject($category, $em, $slug);
        $em->flush();

        return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
    }
}
