<?php

namespace App\Enums;

enum NotificationType: string
{
    case Reminder = 'reminder';
    case PlanUpdate = 'plan_update';
    case Motivational = 'motivational';
}
