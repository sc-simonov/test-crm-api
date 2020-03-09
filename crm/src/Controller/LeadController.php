<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class LeadController extends AbstractController
{
    /**
     * @Route("/leads", name="leads-get", methods={"GET","HEAD"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Get',
        ]);
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
