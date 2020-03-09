<?php

namespace App\Bus\Command\Leads;

class CreateCommand
{
    protected $name = null;
    protected $status = null;
    protected $source = null;

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

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
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param null $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }
}