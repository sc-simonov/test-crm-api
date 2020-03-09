<?php

namespace App\Service\Leads\Response\Adapter;

use App\Entity\Lead;

interface AdapterInterface
{
    public function transform(Lead $lead): array;
}