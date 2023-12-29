<?php

namespace App\Enum;

enum RoleEnum:string {
    case SUPERADMINISTRATOR = "Super Administrator";
    case USER = "User";
    case EMPLOYEE = "Employee";
}
