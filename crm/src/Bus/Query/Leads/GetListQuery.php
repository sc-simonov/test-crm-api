<?php

namespace App\Bus\Query\Leads;

use App\Entity\Lead;

class GetListQuery
{
    protected $status = null;
    protected $createdBy = null;
    protected $limit = null;
    protected $offset = 0;

    protected $count = null;
    protected $totalAmount = null;
    /** @var Lead[] */
    protected $collection = null;

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param null $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param null $limit
     */
    public function setLimit($limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return null
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param null $count
     */
    public function setCount($count): void
    {
        $this->count = $count;
    }

    /**
     * @return null
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param null $totalAmount
     */
    public function setTotalAmount($totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return Lead[]
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * @param Lead[] $collection
     */
    public function setCollection(array $collection): void
    {
        $this->collection = $collection;
    }
}