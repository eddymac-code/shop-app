<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = "INSERT INTO permissions (id, parent_id, name, slug, description)
        VALUES 
        (1, 0, 'Settings', 'settings', 'Access Settings Module'),
        (2, 1, 'View Settings', 'view_settings', 'View all settings'),
        (3, 1, 'Update Settings', 'update_settings', 'Update all settings'),
        (4, 0, 'Users', 'users', 'Access Users Module'),
        (5, 4, 'View Users', 'view_users', 'View users'),
        (6, 4, 'Create Users', 'create_users', 'Create users'),
        (7, 4, 'Update Users', 'update_users', 'Update users'),
        (8, 4, 'Delete Users', 'delete_users', 'Delete users'),
        (9, 0, 'Roles', 'roles', 'Access Roles Module'),
        (10, 9, 'View Roles', 'view_roles', 'View roles'),
        (11, 9, 'Create Roles', 'create_roles', 'Create roles'),
        (12, 9, 'Update Roles', 'update_roles', 'Update roles'),
        (13, 9, 'Delete Roles', 'delete_roles', 'Delete roles'),
        (14, 9, 'Assign Roles', 'assign_roles', 'Assign roles'),
        (15, 0, 'Permissions', 'permissions', 'Access Permissions Module'),
        (16, 15, 'View Permissions', 'view_permissions', 'View permissions'),
        (17, 15, 'Create Permissions', 'create_permissions', 'Create permissions'),
        (18, 15, 'Update Permissions', 'update_permissions', 'Update permissions'),
        (19, 15, 'Delete Permissions', 'delete_permissions', 'Delete permissions'),
        (20, 15, 'Assign Permissions', 'assign_permissions', 'Assign permissions'),
        (21, 0, 'Products', 'products', 'Access Products Module'),
        (22, 21, 'Create Products', 'create_products', 'Add products'),
        (23, 21, 'View Products', 'view_products', 'View products'),
        (24, 21, 'Update Products', 'update_products', 'Update products'),
        (25, 21, 'Delete Products', 'delete_products', 'Delete products'),
        (26, 21, 'Create Product Category', 'create_product_category', ''),
        (27, 21, 'View Product Category', 'view_product_category', ''),
        (28, 21, 'Update Product Category', 'update_product_category', ''),
        (29, 21, 'Delete Product Category', 'delete_product_category', '');";

        DB::unprepared($query);
    }
}
