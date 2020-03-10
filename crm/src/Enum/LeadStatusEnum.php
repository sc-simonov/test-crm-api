<?php

namespace App\Enum;

class LeadStatusEnum
{
    public const NEW = 1;
    public const PENDING = 2;
    public const CLOSED = 3;

    public const DROPDOWN = [
        LeadStatusEnum::NEW,
        LeadStatusEnum::PENDING,
        LeadStatusEnum::CLOSED,
    ];
}