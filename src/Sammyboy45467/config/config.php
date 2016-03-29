<?php

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Tron Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by Tron to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    'role' => 'App\Role',

    /*
    |--------------------------------------------------------------------------
    | Tron Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by Tron to save roles to the database.
    |
    */
    'roles_table' => 'roles',

    /*
    |--------------------------------------------------------------------------
    | Tron Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by Tron to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */
    'permission' => 'App\Permission',

    /*
    |--------------------------------------------------------------------------
    | Tron Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by Tron to save permissions to the
    | database.
    |
    */
    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | Tron permission_user Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by Tron to save relationship
    | between permissions and roles to the database.
    |
    */
    'permission_user_table' => 'permission_user',

    /*
    |--------------------------------------------------------------------------
    | Tron role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by Tron to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on Tron's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | Role Foreign key on Tron's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'role_foreign_key' => 'role_id',

];
