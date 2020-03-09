<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    public function index($exception, $logger)
    {
        return $this->json([
            'error' => $exception->getMessage(),
            'code' => $exception->getStatusCode(),
        ], $exception->getStatusCode());
    }
}
