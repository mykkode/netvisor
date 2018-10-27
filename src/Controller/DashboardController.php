<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashboardController.
 */
class DashboardController extends AbstractController
{
    public function index(): Response
    {
        return new Response("merge");
    }
}