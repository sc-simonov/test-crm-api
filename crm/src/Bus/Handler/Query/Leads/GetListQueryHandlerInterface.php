<?php

namespace App\Bus\Handler\Query\Leads;

use App\Bus\Query\Leads\GetListQuery;

interface GetListQueryHandlerInterface
{
    public function __invoke(GetListQuery $query): GetListQuery;
}