<?php

namespace App\Enums;

enum CareerPlanStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Completed = 'completed';
}
