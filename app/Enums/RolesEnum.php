<?php 

namespace App\Enums;

enum RolesEnum: string
{
    case PREMIUM = 'premium';
    case VIP = 'vip';
    case ADMIN = 'admin';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::PREMIUM => 'Premium',
            static::VIP => 'Vip',
            static::ADMIN => 'Admin',
        };
    }
}