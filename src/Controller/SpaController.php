<?php

namespace App\Controller;

use App\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaController extends AbstractController
{
    #[Route('/', name: 'app_index', methods:["GET"])]
    public function index(EntityManagerInterface $em): Response
    {
        // Getting the logs for the page
        $logs = $em->getRepository(Log::class)->findAll();
        $guestbook = [];

        foreach ($logs as $log) {
            $guestbook[] = [
                "id" => $log->getId(),
                "user" => $log->getUser(),
                "message" => $log->getMessage(),
                "datetime" => $log->getCreated()->format("d.m.Y H:i"),
            ];
        }

        return $this->render('spa/index.html.twig', [
            'guestbook' => $guestbook,
        ]);
    }

    #[Route('/create', name: 'app_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        // Setting up the EntityManager
        $em = $doctrine->getManager();

        // Getting the user input and time
        $user = trim($request->get("name"));
        $message = trim($request->get("message"));
        $datetime = new \DateTime("now");

        if (empty($user || $message)) {
            return $this->redirectToRoute('app_index');
        } else {
            // Setting log ready
            $log = new Log();
            $log->setUser($user);
            $log->setMessage($message);
            $log->setCreated($datetime);

            // Making log ready and posting it into DB
            $em->persist($log);
            $em->flush();

            // Redirect user back to index
            return $this->redirectToRoute('app_index');
        }
    }
}
