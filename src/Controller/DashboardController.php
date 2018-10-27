<?php

namespace App\Controller;

use App\Entity\Device;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @param DatabaseService $databaseService
     *
     * @return Response
     */
    public function devices(DatabaseService $databaseService): Response
    {
        return $this->render('dashboard/devices.html.twig', [
            'devices' => $databaseService->findAll(Device::class),
        ]);
    }

    public function locations(Request $request, DatabaseService $databaseService): Response
    {
        $name = $request->get('name');
        $device = new Device($name);
        $databaseService->save($device);

        return $this->render('dashboard/locations.html.twig');
    }

    public function opened_issues(): Response
    {
        return $this->render('dashboard/opened_issues.html.twig');
    }
    public function entities(): Response
    {
        return $this->render('dashboard/entities.html.twig');
    }
}