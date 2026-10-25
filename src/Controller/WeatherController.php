<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\ForecastRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function city(#[MapEntity(expr: 'repository.findOneBy({"country": country, "city": city})')]
        Location $location,
        ForecastRepository $repository): Response {
        $forecasts = $repository->findByLocation($location);

        return $this->render('weather/index.html.twig', [
            'location' => $location,
            'forecasts' => $forecasts,
        ]);
    }
}
