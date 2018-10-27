<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashboardController.
 */
class DashboardController extends AbstractController
{
    public function home(): Response
    {
        return $this->render("dashboard/dashboard.html.twig");
    }
    public function users(): Response
    {
        return $this->render('dashboard/users.html.twig');
    }

    public function devices(): Response
    {
        return $this->render('dashboard/devices.html.twig');
    }

    public function locations(): Response
    {
        return $this->render('dashboard/locations.html.twig');
    }

    public function opened_issues(): Response
    {
        return $this->render('dashboard/opened_issues.html.twig');
    }
}