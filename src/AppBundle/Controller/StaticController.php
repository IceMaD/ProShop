<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StaticController extends Controller
{
    /**
     * @Route("/")
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {
    }
    
    /**
     * @Route("/app")
     *
     * @Template()
     */
    public function appAction(Request $request)
    {
    }
}
