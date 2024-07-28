<?php

namespace App\Controller;

use App\Service\Scraper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $scraper = new Scraper();
        $infosScraped = $scraper->extractInfos('https://fr.trustpilot.com/review/outillage-du-mecanicien.fr');
        $title = $infosScraped['title'];
        $numberReviews = $infosScraped['numberReviews'];

        return $this->render('home/index.html.twig', [
            'infos' => $infosScraped,
        ]);
    }
}
