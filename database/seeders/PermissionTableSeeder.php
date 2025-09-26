<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-employees',
            'add-employee',
            'edit-employees',
            'view-sales',
            'add-sale',
            'edit-sales',
            'view-materials',
            'add-material',
            'edit-materials',
            'view-places',
            'add-place',
            'edit-places',
            'view-vehicles',
            'add-vehicle',
            'edit-vehicles',
            'view-royalty',
            'add-royalty',
            'edit-royalty',
            'view-party',
            'add-party',
            'edit-party',
            'view-loading',
            'add-loading',
            'edit-loading',
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists before creating
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}