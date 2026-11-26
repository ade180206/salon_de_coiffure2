<?php

namespace App\Enums;

enum UserRole: string
{
    case MANAGER = 'manager';
    case HAIDRESSER = 'haidresser';
    case CUSTOMER = 'customer';
}