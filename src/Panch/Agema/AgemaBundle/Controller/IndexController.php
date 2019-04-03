<?php

namespace Panch\Agema\AgemaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var string Site name
     */
    protected $siteName;

    /**
     * @var string Page title
     */
    protected $pageTitle;

    public function __construct()
    {
        // TODO: Add entity for site & page options. Return array of options properties from database.
        $this->siteName = 'Agema Optics';
        $this->pageTitle = 'Homepage';
    }

    /**
     * This method render index page (Front Controller)
     *
     * @Template()
     * @Route("/")
     * @Method("GET")
     *
     * @return array
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getManager()->getRepository('PanchAgemaBundle:Product')->findBy(
            array('deletedAt' => null),
            array('id' => 'DESC'), 3);

        return [
                'site_name'     => $this->siteName,
                'page_title'    => $this->pageTitle,
                'products'      => $products,
        ];
    }

    /**
     * This method checking access right for current User
     *
     * @Template()
     *
     * @return array
     */
    public function permissionsAction()
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $role = $user->getRoles();

            return [ 'user_roles' => $role ];
        }

        return [ $this->get('router')->generate('panch_agema_agema_index_index') ];
    }
}
