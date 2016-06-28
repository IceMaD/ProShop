<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @Route(
     *     "/view/{name}",
     *     requirements={"name": "(?:(?:[A-Z][a-z]+)+\/)+(?:[A-Z][a-z]+)+"},
     *     options={"expose": true}
     *     )
     */
    public function viewAction($name)
    {
        try {
            return $this->render(sprintf('@App/Static/%s.html.twig', $name));
        } catch (\InvalidArgumentException $e) {
            $dev = $this->get('kernel')->getEnvironment() === 'dev';

            throw new NotFoundHttpException($dev ? $e->getMessage() : '');
        }
    }
}
