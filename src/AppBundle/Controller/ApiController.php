<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 *
 * @Route("/api", options={"expose": true})
 */
class ApiController extends Controller
{
    /**
     * @Route("/url")
     * @Method("POST")
     */
    public function urlAction(Request $request)
    {
        $url = json_decode($request->getContent(), true)['url'];

        try {
            return new JsonResponse($this->get('app.service.web_crawler')->crawl($url));
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse($e->getMessage(), 422);
        }
    }
}
