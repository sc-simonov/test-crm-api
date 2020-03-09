<?php

namespace App\Service\Leads\Response;

interface ResponseInterface
{
    public function normalize($message);
}