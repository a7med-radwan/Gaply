<?php

namespace App\Enums;

enum CareerPlanStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
    case Archived = 'archived';
}
