<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Issue;
use App\Entity\Location;
use App\Entity\Node;
use App\Entity\User;
use App\Service\DatabaseService;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    public function getAllUsers(DatabaseService $databaseService):Response
    {
        $output=$databaseService->findAll(User::class);

        return $this->json($output);
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

    public function addNod(DatabaseService $databaseService, Request $request):Response
    {
        $nameDevice=$request->get('nameDevice');
        $nameLocation=$request->get('nameLocation');
        $location = $databaseService->findOneBy(Location::class, ['name' => $nameLocation]);
        $device = $databaseService->findOneBy(Device::class, ['name' => $nameDevice]);
        $node=new Node($device,$location);

        $output=$databaseService->save($node);

        return $this->json($output);
    }

    public function getAllNodes(DatabaseService $databaseService):Response
    {
        $output=$databaseService->findAll(Node::class);

        return $this->json($output);
    }

    public function deleteNode(Request $request, DatabaseService $databaseService):Response
    {
        $id=$request->get('id');

        $node = $databaseService->find(Node::class, $id);

        $output=$databaseService->delete($node);

        return $this->json($output);
    }

    public function deleteLocation(Request $request, DatabaseService $databaseService):Response
    {
        $id=$request->get('id');

        $location = $databaseService->find(Location::class, $id);

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

    public function nodes(): Response
    {
        return $this->render('dashboard/nodes.html.twig');
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

    /**
     * @param DatabaseService $databaseService
     *
     * @return Response
     */
    public function getOpenIssues(DatabaseService $databaseService): Response
    {
        $openIssues = $databaseService->findBy(Issue::class, ['open' => true]);

        return $this->json($openIssues);
    }

    /**
     * @param Issue $issue
     * @param DatabaseService $databaseService
     * @param TokenStorageInterface $tokenStorage
     *
     * @return JsonResponse
     */
    public function assignIssue(Issue $issue, DatabaseService $databaseService, TokenStorageInterface $tokenStorage): JsonResponse
    {
        /** @var User $user */
        $user = $tokenStorage->getToken()->getUser();
        $issue->setAssignee($user);

        return $this->json($databaseService->save($issue));
    }

    /**
     * @param Issue $issue
     * @param DatabaseService $databaseService
     *
     * @return JsonResponse
     */
    public function solveIssue(Issue $issue, DatabaseService $databaseService): JsonResponse
    {
        $issue->setOpen(false);

        return $this->json($databaseService->save($issue));
    }
}