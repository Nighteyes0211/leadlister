<?php

namespace App\Enum;

use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Support\Arr;

enum RoleGroupEnum:string {
    case ORGANIZATION = "Organization";

    public function roles() {
        return match($this) {
            self::ORGANIZATION => [
                RoleEnum::SUPERADMINISTRATOR->value,
                RoleEnum::USER->value,
            ],
        };
    }

    public function strRoles()
    {
        return implode(',', $this->roles());
    }

    public function dashboard() {
        return match($this){
            self::ORGANIZATION => route('organization.dashboard'),
        };
    }

    public function menu() {
        return match($this){
            self::ORGANIZATION => 'users.organization.menu',
        };
    }

}

?>
