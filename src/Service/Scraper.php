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

    public function extractInfos(string $url): array
    {
        $crawler = $this->client->request('GET', $url);

        $title = $crawler->filter('[class*="title_displayName"]')->text('not found');
        $reviews = $crawler->filter('h1 ~ span > span')->text('not found');
        $numberReviews = (int) filter_var($reviews, FILTER_SANITIZE_NUMBER_INT);
        $arrayReview = (explode(' ', $reviews));
        $qualityReview = trim(end($arrayReview), " \t\n\r\0\x0B\xC2\xA0") ?? 'not found';

        $rating = $crawler->filter('[class*="star-rating_starRating"] ~ p')->text('not found');

        return [
            'title' => $title,
            'numberReviews' => $numberReviews,
            'qualityReview' => $qualityReview,
            'rating' => $rating,
        ];
    }
}
