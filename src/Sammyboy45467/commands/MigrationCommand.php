<?php namespace Sammyboy45467\Tron;

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tron:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the Tron specifications.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel->view->addNamespace('tron', substr(__DIR__, 0, -8).'views');

        $rolesTable          = Config::get('tron.roles_table');
        $roleUserTable       = Config::get('tron.role_user_table');
        $permissionsTable    = Config::get('tron.permissions_table');
        $permissionUserTable = Config::get('tron.permission_user_table');
        $trackerTable = Config::get('tron.tracker');

        $this->line('');
        $this->info( "Tables: $rolesTable, $roleUserTable, $permissionsTable, $permissionUserTable, $trackerTable" );

        $message = "A migration that creates '$rolesTable', '$roleUserTable', '$permissionsTable', '$permissionUserTable', '$trackerTable'".
        " tables will be created in database/migrations directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {

            $this->line('');

            $this->info("Creating migration...");
            if ($this->createMigration($rolesTable, $roleUserTable, $permissionsTable, $permissionUserTable, $trackerTable)) {

                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissions".
                    " within the database/migrations directory."
                );
            }

            $this->line('');

        }
    }

    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function createMigration($rolesTable, $roleUserTable, $permissionsTable, $permissionUserTable, $trackerTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_tron_setup_tables.php";

        $usersTable  = Config::get('auth.providers.users.table');
        $userModel   = Config::get('auth.providers.users.model');
        $userKeyName = (new $userModel())->getKeyName();

        $data = compact('rolesTable', 'roleUserTable', 'permissionsTable', 'permissionUserTable', 'usersTable', 'userKeyName', 'trackerTable');

        $output = $this->laravel->view->make('tron::generators.migration')->with($data)->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}
