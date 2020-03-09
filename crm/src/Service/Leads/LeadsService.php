<?php

namespace App\Service\Leads;

use App\Bus\Query\Leads\GetListQuery;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class LeadsService
 * @package App\Service\Leads
 */
class LeadsService implements LeadsServiceInterface
{
    /** @var MessageBusInterface|null  */
    protected $bus = null;

    /**
     * LeadsService constructor.
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param array $params
     * @return Envelope
     */
    public function getList(array $params): Envelope
    {
        $query = new GetListQuery();

        foreach ($params as $name => $value) {
            $method = 'set'.ucfirst($name);

            if (!method_exists($query, $method)) {
                throw new BadRequestHttpException('Unknown option \''.$name.'\'');
            }

            $query->$method($value);
        }

        return $this->bus->dispatch($query);
    }

    public function create()
    {
        return [
            'method' => 'Create',
        ];
    }
}