<?php

namespace Database\Seeders;

use App\Enums\TeamRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Project permissions
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'complete projects',

            // Client permissions
            'view clients',
            'create clients',
            'edit clients',
            'delete clients',

            // Invoice permissions
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            'send invoices',

            // Offer permissions
            'view offers',
            'create offers',
            'edit offers',
            'delete offers',
            'send offers',
            'convert offers',

            // Team permissions
            'view team',
            'manage team',

            // Blog permissions
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',

            // Brainstorm permissions
            'use brainstorm',

            // Milestone permissions
            'view milestones',
            'create milestones',
            'edit milestones',
            'delete milestones',
            'complete milestones',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create roles from TeamRole enum and assign permissions
        $adminRole = Role::findOrCreate(TeamRole::Admin->value);
        $adminRole->givePermissionTo(Permission::all());

        $pmRole = Role::findOrCreate(TeamRole::ProjectManager->value);
        $pmRole->givePermissionTo([
            'view projects', 'create projects', 'edit projects', 'complete projects',
            'view clients', 'create clients', 'edit clients',
            'view invoices', 'create invoices', 'edit invoices', 'send invoices',
            'view offers', 'create offers', 'edit offers', 'send offers', 'convert offers',
            'view team',
            'view milestones', 'create milestones', 'edit milestones', 'complete milestones',
            'use brainstorm',
        ]);

        $devRole = Role::findOrCreate(TeamRole::Developer->value);
        $devRole->givePermissionTo([
            'view projects', 'edit projects',
            'view clients',
            'view milestones', 'create milestones', 'edit milestones', 'complete milestones',
            'view posts', 'create posts', 'edit posts',
            'use brainstorm',
        ]);

        $designerRole = Role::findOrCreate(TeamRole::Designer->value);
        $designerRole->givePermissionTo([
            'view projects', 'edit projects',
            'view clients',
            'view milestones', 'edit milestones', 'complete milestones',
            'view posts', 'create posts', 'edit posts',
            'use brainstorm',
        ]);

        // Assign admin role to first user
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->assignRole(TeamRole::Admin->value);
        }
    }
}
