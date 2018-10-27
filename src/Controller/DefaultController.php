<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DefaultController.
 */
class DefaultController extends AbstractController
{
    /**
     * @return RedirectResponse
     */
    public function home(): RedirectResponse
    {
        return $this->redirectToRoute('dashboard');
    }
}