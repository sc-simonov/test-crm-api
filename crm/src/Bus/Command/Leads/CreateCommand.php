<?php

namespace App\Bus\Command\Leads;

use Symfony\Component\Validator\ConstraintViolation;

class CreateCommand
{
    protected $name = null;
    protected $status = null;
    protected $sourceId = null;
    protected $errors = null;

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
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @param null $source
     */
    public function setSourceId($source): void
    {
        $this->sourceId = $source;
    }

    /**
     * @return null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param null $errors
     * @return CreateCommand
     */
    public function setErrors($errors): CreateCommand
    {
        foreach ($errors as $error) {
            /** @var ConstraintViolation $error */
            $this->errors[$error->getPropertyPath()] = $error->getMessage();
        }

        return $this;
    }
}