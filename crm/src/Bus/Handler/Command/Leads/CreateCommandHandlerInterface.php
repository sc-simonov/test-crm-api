<?php

namespace App\Bus\Handler\Command\Leads;

use App\Bus\Command\Leads\CreateCommand;

interface CreateCommandHandlerInterface
{
    public function __invoke(CreateCommand $command): CreateCommand;
}