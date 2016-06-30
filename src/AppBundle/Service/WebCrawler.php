<?php

namespace AppBundle\Service;

use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;

class WebCrawler
{
    /**
     * @var []
     */
    private $configuration;

    /**
     * WebCrawler constructor.
     */
    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function crawl($url)
    {
        $host = parse_url($url)['host'];

        $config = $this->getConfiguration($host);

        $client = new Client($url);
        $response = $client->get()->send();

        $data = [
            'supplier' => $config['supplier']
        ];

        $crawler = new Crawler($response->getBody(true));
        $data['title'] = $this->getText($crawler, $config['title']);
        $data['reference'] = $this->getText($crawler, $config['reference']);
        $data['price'] = $this->getText($crawler, $config['price']);
        $data['brand'] = $this->getText($crawler, $config['brand']);
        $data['image'] = $crawler->filterXPath($config['image'])->extract(['_text', 'src'])[0][1];

        return $data;
    }

    private function getText(Crawler $crawler, $value)
    {
        return null != $value ? $crawler->filterXPath($value)->text() : null;
    }

    private function getConfiguration($host)
    {
        if (!isset($this->configuration[$host])) {
            throw new \InvalidArgumentException($host);
        }

        return $this->configuration[$host];
    }
}
