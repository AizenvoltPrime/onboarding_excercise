<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case Complete = 'complete';
}
