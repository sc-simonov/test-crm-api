<?php

namespace App\Service\Leads\Response;

use App\Bus\Query\Leads\GetListQuery;
use App\Service\Leads\Response\Adapter\AdapterInterface;

/**
 * Class JSONPaginatedResponse
 * @package App\Service\Leads\Response
 */
class JSONPaginatedResponse implements ResponseInterface
{
    /** @var AdapterInterface|null  */
    protected $adapter = null;

    /**
     * JSONPaginatedResponse constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param GetListQuery $message
     * @return array|mixed
     */
    public function normalize($message)
    {
        $data = [];

        foreach ($message->getCollection() as $lead) {
            $data[] = $this->adapter->transform($lead);
        }

        return [
            'data' => $data,
            'meta' => [
                'count' => count($message->getCollection()),
                'total' => $message->getTotalAmount(),
            ],
        ];
    }
}