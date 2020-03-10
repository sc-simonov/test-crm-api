<?php

namespace App\Bus\Handler\Command\Leads;

use App\Bus\Command\Leads\CreateCommand;
use App\Entity\Lead;
use App\Entity\Source;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateCommandHandler implements CreateCommandHandlerInterface
{
    /** @var ValidatorInterface|null */
    protected $validator = null;
    /** @var Security|null  */
    protected $security = null;
    /** @var EntityManagerInterface|null  */
    protected $em = null;

    /**
     * CreateCommandHandler constructor.
     * @param ValidatorInterface $validator
     * @param Security $security
     * @param EntityManagerInterface $em
     */
    public function __construct(ValidatorInterface $validator, Security $security, EntityManagerInterface $em)
    {
        $this->validator = $validator;
        $this->security = $security;
        $this->em = $em;
    }

    /**
     * @param CreateCommand $command
     * @return CreateCommand
     * @throws \Exception
     */
    public function __invoke(CreateCommand $command): CreateCommand
    {
        $entity = $this->getEntityFromCommand($command);

        $errors = $this->validator->validate($entity);
        if (count($errors)) {
            return $command->setErrors($errors);
        }

        $this->em->persist($entity);
        $this->em->flush();

        return $command;
    }

    /**
     * @param CreateCommand $command
     * @return Lead
     * @throws \Exception
     */
    protected function getEntityFromCommand(CreateCommand $command): Lead
    {
        $entity = new Lead();

        $entity->setName($command->getName());
        if ($command->getSourceId()) {
            $source = $this->em->getRepository(Source::class)->find($command->getSourceId());
            if ($source) {
                $entity->setSourceId($source);
            }
        }
        $entity->setStatus($command->getStatus());
        $entity->setCreatedBy($this->security->getUser());
        $entity->setCreatedAt(new \DateTime());

        return $entity;
    }
}