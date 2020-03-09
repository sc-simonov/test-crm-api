<?php

namespace App\Bus\Handler\Query\Leads;

use App\Bus\Query\Leads\GetListQuery;
use App\Repository\LeadRepository;
use Doctrine\Common\Collections\Criteria;

/**
 * Class GetListQueryHandler
 * @package App\Bus\Handler\Query\Leads
 */
class GetListQueryHandler implements GetListQueryHandlerInterface
{
    /** @var LeadRepository */
    protected $repository = null;

    /**
     * GetListQueryHandler constructor.
     * @param LeadRepository $repository
     */
    public function __construct(LeadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GetListQuery $query
     * @return GetListQuery
     */
    public function __invoke(GetListQuery $query): GetListQuery
    {
        $criteria = $this->buildCriteria($query);
        $query->setCollection($this->repository->findBy($criteria, null, $query->getLimit(), $query->getOffset()));
        $query->setTotalAmount($this->repository->count($criteria));

        return $query;
    }

    /**
     * @param GetListQuery $query
     * @return array
     */
    protected function buildCriteria(GetListQuery $query): array
    {
        $criteria = [];

        if ($query->getStatus()) {
            $criteria['status'] = $query->getStatus();
        }

        if ($query->getCreatedBy()) {
            $criteria['created_by'] = $query->getCreatedBy();
        }

        return $criteria;
    }
}