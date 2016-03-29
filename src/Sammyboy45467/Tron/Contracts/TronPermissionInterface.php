<?php namespace Sammyboy45467\Tron\Contracts;

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

interface TronPermissionInterface
{
    
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
