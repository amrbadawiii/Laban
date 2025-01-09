<?php

namespace App\Domain\Enums;

enum UserType: string
{
    case Admin = 'admin';
    case User = 'user';
}
