<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Issue;
use App\Entity\Location;
use App\Entity\Node;
use App\Entity\User;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    public function insertDevice(DatabaseService $databaseService, Request $request):Response
    {
        $name=$request->get('name');
        $device=new Device($name);
        $output=$databaseService->save($device);

        return $this->json($output);
    }

    public function deleteDevice(Request $request, DatabaseService $databaseService):Response
    {
        $id=$request->get('id');

        $device = $databaseService->find(Device::class, $id);

//        $nodes = $databaseService->findBy(Node::class, ['device' => $device]);
//        foreach ($nodes as $node) {
//            $databaseService->delete($node);
//        }

        $output=$databaseService->delete($device);

        return $this->json($output);
    }

    public function getAllDevices(DatabaseService $databaseService):Response
    {
        $output=$databaseService->findAll(Device::class);

        return $this->json($output);
    }

    public function insertLocation(DatabaseService $databaseService, Request $request):Response
    {
        $name=$request->get('name');
        $device=new Location($name);
        $output=$databaseService->save($device);

        return $this->json($output);
    }

    public function deleteLocation(Request $request, DatabaseService $databaseService):Response
    {
        $id=$request->get('id');

        $location = $databaseService->find(Location::class, $id);

//        $nodes = $databaseService->findBy(Node::class, ['location' => $location]);
//        foreach ($nodes as $node) {
//            $databaseService->delete($node);
//        }

        $output=$databaseService->delete($location);

        return $this->json($output);
    }

    public function getAllLocations(DatabaseService $databaseService):Response
    {
        $output=$databaseService->findAll(Location::class);

        return $this->json($output);
    }

    public function locations(): Response
    {
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

    /**
     * @param Node $node
     * @param string $username
     * @param DatabaseService $databaseService
     *
     * @return JsonResponse
     */
    public function addIssue(Node $node, string $username, DatabaseService $databaseService): JsonResponse
    {
        /** @var User $user */
        $user = $databaseService->findOneBy(User::class, ['username' => $username]);

        $issue = new Issue($node, $user);

        return $this->json(['error' => !$databaseService->save($issue)]);
    }
}