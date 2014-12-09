<?php

namespace Panch\Agema\AgemaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Template()
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        // TODO: Add entity for site & page options. Return options properties array from database.
        $siteName = 'Agema optics';
        $pageTitle = 'Homepage';

        return array('sitename'    => $siteName,
                     'pagetitle'   => $pageTitle
        );
    }
}
