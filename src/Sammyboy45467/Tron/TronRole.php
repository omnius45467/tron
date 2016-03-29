<?php namespace Sammyboy45467\Tron;

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

use Sammyboy45467\Tron\Contracts\TronRoleInterface;
use Sammyboy45467\Tron\Traits\TronRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class TronRole extends Model implements TronRoleInterface
{
    use TronRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('tron.roles_table');
    }

}
