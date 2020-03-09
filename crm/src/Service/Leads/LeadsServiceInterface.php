<?php

namespace App\Service\Leads;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Envelope;

interface LeadsServiceInterface
{
    public function getList(array $params): Envelope;
    public function create();
}