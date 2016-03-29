<?php namespace Sammyboy45467\Tron;

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

use Sammyboy45467\Tron\Contracts\TronPermissionInterface;
use Sammyboy45467\Tron\Traits\TronPermissionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class TronPermission extends Model implements TronPermissionInterface
{
    use TronPermissionTrait;

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
        $this->table = Config::get('tron.permissions_table');
    }

}
