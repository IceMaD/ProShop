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
      //Fetch Wishlist
      //get user
      //get wishlists by user ID
      $em = $this->getDoctrine()->getManager();
      //get user Id
      $userId = $this->getUser()->getId();
      //get user's wishlists
      $wishlists = $em->getRepository('AppBundle:Wishlist')->findByOwner($userId);
      //get wishlist's demands

      //Fetch

      return array(
          'user' => $userId,
          'wishlists' => $wishlists,
      );
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
