<?php

namespace AppBundle\Controller;

use Guzzle\Http\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 *
 * @Route("/api", options={"expose": true})
 */
class ApiController
{
    /**
     * @Route("/url")
     * @Method("POST")
     */
    public function urlAction(Request $request)
    {
        $url = json_decode($request->getContent(), true)['url'];

        $client = new Client($url);
        $response = $client->get()->send();

        $crawler = new Crawler($response->getBody(true));
        $title = $crawler->filterXPath('//*[@id="fiche"]/div[1]/span[1]')->text();
        $reference = $crawler->filterXPath('//*[@id="fiche"]/div[1]/span[2]/span')->text();
        $price = $crawler->filterXPath('//*[@id="fiche"]/div[1]/div/div[3]/span[1]/text()[1]')->text();
        $brand = $crawler->filterXPath('//*[@id="productDetail"]/ul/li[3]/span[2]/u/a')->text();
        $image = $crawler->filterXPath('//*[@id="zoomProduct"]/img')->extract(array('_text', 'src'));

        return new JsonResponse([
            'supplier' => 'LDLC pro',
            'title' => trim($title),
            'reference' => trim($reference),
            'price' => trim($price),
            'brand' => trim($brand),
            'image' => $image[0][1],
        ]);
    }
}
