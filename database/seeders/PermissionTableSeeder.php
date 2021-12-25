<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder {

    public function run() {

        $permissions = [
            
            'Administrateur' => [
                'users-list',
                'users-show',
                'users-create',
                'users-edit',
                'users-delete',

                'roles-list',
                'roles-show',
                'roles-create',
                'roles-edit',
                'roles-delete',

                'permissions-list',
                'permissions-show',
                'permissions-create',
                'permissions-edit',
                'permissions-delete',

                
                'posts-list',
                'posts-show',
                'posts-create',
                'posts-edit',
                'posts-delete',

                'admin-pannel',
            ],

            'Utilisateur' => [


            ]

        ];


        foreach ($permissions as $role => $permission) {

            $role = Role::create(['name' => $role]);

            foreach ($permission as $permission) {

                $permission = Permission::firstOrCreate(['name' => $permission]);

                $role->givePermissionTo($permission);

            }

        }


    }
}