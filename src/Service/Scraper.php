<?php

namespace App\Service;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class Scraper extends HttpBrowser
{
    private $client;

    public function __construct()
    {
        $this->client = new HttpBrowser(HttpClient::create());
    }
}
