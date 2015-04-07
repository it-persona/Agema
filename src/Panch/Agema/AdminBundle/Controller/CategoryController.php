<?php

namespace Panch\Agema\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\PropertyAccess\PropertyAccessor;
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
                $errors = $this->get('validator')->validate($category);
            }
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
            if ($form->isValid() && $data == !null) {
                $accessor = new PropertyAccessor();
                $reflect = new \ReflectionClass($data);

                $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE);

                foreach ($properties as $property) {
                    $propertyName = $property->getName();
                    $value = $accessor->getValue($category, $propertyName);

                    if ($value == !null && $value !== $accessor->getValue($data, $propertyName)) {
                        $accessor->setValue($data, $propertyName, $value);
                    }
                }

                $this->get('doctrine.orm.entity_manager')->flush();

                return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
            }
                $errors = $this->get('validator')->validate($category);
        }

        return [
                'page_title'    => 'Edit Category',
                'data'          => $data->getName(),
                'form'          => $form->createView(),
                'errors'        => $errors,
        ];
    }

    /**
     * This method delete category by slug
     *
     * @Route("/admin/category/remove/{slug}")
     * @Method("GET")
     *
     * @param $slug
     * @return Route
     */
    public function removeAction($slug)
    {
        $category = $this->getDoctrine()->getManager()->getRepository('PanchAgemaBundle:Category')->findOneBy(array('slug' => $slug));

        if (!null == $category && $category->getSlug() == $slug) {
            $this->getDoctrine()->getManager()->remove($category);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('panch_agema_admin_category_list'));
    }

}
