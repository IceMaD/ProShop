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
      // //Fetch Wishlist
      // //get user
      // //get wishlists by user ID
      // $em = $this->getDoctrine()->getManager();
      // //get user Id
      // $user = $this->getUser();
      // $userId = $user->getId();
      // //get user's wishlists
      // $wishlists_attente = $em->getRepository('AppBundle:Wishlist')->findBy(
      //   array('owner'=>$userId,'status'=>'En attente')
      // );
      // $wishlists_done = $em->getRepository('AppBundle:Wishlist')->findBy(
      //   array('owner'=>$userId,'status'=>'Traitée')
      // );
      //
      //
      // //Fetch team's wishlists
      // $members = $this->get('fos_user.user_manager')->findUsers();
      // //->findBy($this->getUser()->getTeam());
      // $team_members = array();
      // $team_wishlists = array();
      // foreach ($members as $member) {
      //   if ( $member->getTeam() == $this->getUser()->getTeam() ) {
      //     array_push($team_wishlists,$em->getRepository('AppBundle:Wishlist')->findBy(array('owner'=>$member->getId(),'status'=>'En attente'))[0]);
      //     $team_members[$member->getId()]=$member;
      //   }
      // }
      //
      //
      //
      // return array(
      //     'user' => $user,
      //     'wishlists_attente' => $wishlists_attente,
      //     'wishlists_done' => $wishlists_done,
      //     'team_wishlists' => $team_wishlists,
      //     'team_members' => $team_members,
      // );
    }

    /**
     * @Route("/dashboard")
     *
     * @Template()
     */
    public function dashboardAction(Request $request)
    {
      //Fetch Wishlist
      //get user
      //get wishlists by user ID
      $em = $this->getDoctrine()->getManager();
      //get user Id
      $user = $this->getUser();
      $userId = $user->getId();
      //get user's wishlists
      $wishlists_attente = $em->getRepository('AppBundle:Wishlist')->findBy(
        array('owner'=>$userId,'status'=>'En attente')
      );
      $wishlists_done = $em->getRepository('AppBundle:Wishlist')->findBy(
        array('owner'=>$userId,'status'=>'Traitée')
      );


      //Fetch team's wishlists
      $members = $this->get('fos_user.user_manager')->findUsers();
      //->findBy($this->getUser()->getTeam());
      $team_members = array();
      $team_wishlists = array();
      foreach ($members as $member) {
        if ( $member->getTeam() == $this->getUser()->getTeam() ) {
          array_push($team_wishlists,$em->getRepository('AppBundle:Wishlist')->findBy(array('owner'=>$member->getId(),'status'=>'En attente'))[0]);
          $team_members[$member->getId()]=$member;
        }
      }



      return array(
          'user' => $user,
          'wishlists_attente' => $wishlists_attente,
          'wishlists_done' => $wishlists_done,
          'team_wishlists' => $team_wishlists,
          'team_members' => $team_members,
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
