<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController.
 */
class AuthController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('login.html.twig');
    }

}