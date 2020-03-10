<?php

namespace App\Service\Leads;

use App\Bus\Command\Leads\CreateCommand;
use App\Bus\Query\Leads\GetListQuery;
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

        return $this->bus->dispatch($this->fillObject($query, $params));
    }

    /**
     * @param array $params
     * @return
     */
    public function create(array $params)
    {
        $command = new CreateCommand();
        $command = $this->bus->dispatch($this->fillObject($command, $params))->getMessage();

        return $command->getErrors();
    }

    protected function fillObject($object, $params)
    {
        foreach ($params as $name => $value) {
            $segments = explode('_', $name);
            $segments = array_map(function($i) {
                return ucfirst($i);
            }, $segments);

            $method = 'set'.implode($segments);

            if (!method_exists($object, $method)) {
                throw new BadRequestHttpException('Unknown option \''.$name.'\'');
            }

            $object->$method($value);
        }

        return $object;
    }
}