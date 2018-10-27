<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param DatabaseService $databaseService
     *
     * @return JsonResponse
     */
    public function checkCredentials(
        Request $request,
        UserPasswordEncoderInterface $userPasswordEncoder,
        DatabaseService $databaseService
    ): JsonResponse
    {
        $username = $request->get('username');
        $password = $request->get('password');

        /** @var User $user */
        $user = $databaseService->findOneBy(User::class, ['username' => $username]);
        if (!$user instanceof User) {
            return $this->json([
                'error' => true,
                'message' => 'Wrong username!',
                'username' => $username,
            ]);
        }

        if (!$userPasswordEncoder->isPasswordValid($user, $password)) {
            return $this->json([
                'error' => true,
                'message' => 'Wrong password!'
            ]);
        }

        return $this->json([
            'error' => false,
        ]);
    }

}