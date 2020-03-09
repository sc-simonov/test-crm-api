<?php

namespace App\Controller;

use App\Service\Leads\LeadsServiceInterface;
use App\Service\Leads\Response\JSONPaginatedResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Routing\Annotation\Route;

class LeadController extends AbstractController
{
    /**
     * @Route("/leads", name="leads-get", methods={"GET","HEAD"})
     * @param LeadsServiceInterface $leadsService
     * @param JSONPaginatedResponse $response
     * @param Request $request
     * @return JsonResponse
     */
    public function index(LeadsServiceInterface $leadsService, JSONPaginatedResponse $response, Request $request)
    {
        $query = $leadsService
            ->getList($request->query->all())
            ->getMessage();

        return $this->json($response->normalize($query));
    }

    /**
     * @Route("/leads", name="leads-post", methods={"POST"})
     */
    public function create()
    {
        return $this->json([
            'message' => 'Post',
        ]);
    }
}
