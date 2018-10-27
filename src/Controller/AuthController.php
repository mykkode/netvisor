<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AuthController.
 */
class AuthController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authUtils
     * @param AuthorizationCheckerInterface $authorizationChecker
     *
     * @return Response
     */
    public function login(
        AuthenticationUtils $authUtils,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response
    {
        if ($authorizationChecker->isGranted(User::ROLE_USER)) {
            return $this->redirectToRoute('dashboard');
        }

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    public function logout(): void
    {

    }



    public function index(): Response
    {
        return $this->render('auth/login.html.twig');
    }
    public function dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

}