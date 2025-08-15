<?php

namespace App\Enums;

enum RoleType: string
{
    case ADMIN = 'admin';
    case PROJECT_MANAGER = 'project_manager';
    case MAINTENANCE_MANAGER = 'maintenance_manager';
}