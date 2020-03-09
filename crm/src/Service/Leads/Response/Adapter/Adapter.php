<?php

namespace App\Service\Leads\Response\Adapter;

use App\Entity\Lead;

/**
 * Class Adapter
 * @package App\Service\Leads\Response\Adapter
 */
class Adapter implements AdapterInterface
{
    /**
     * @param Lead $lead
     * @return array
     */
    public function transform(Lead $lead): array
    {
        return [
            'id' => $lead->getId(),
            'name' => $lead->getName(),
            'status' => $lead->getStatus(),
            'source' => [
                'id' => $lead->getSourceId()->getId(),
                'name' => $lead->getSourceId()->getName(),
            ],
            'created_by' => [
                'id' => $lead->getCreatedBy()->getId(),
                'name' => $lead->getCreatedBy()->getName(),
            ],
            'created_at' => $lead->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}