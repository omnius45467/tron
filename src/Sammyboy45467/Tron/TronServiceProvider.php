<?php namespace Sammyboy45467\Tron;

/**
 * This file is part of Tron,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Sammyboy45467\Tron
 */

use Illuminate\Support\ServiceProvider;

class TronServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Publish config files
		$this->publishes([
			__DIR__ . '/../config/config.php' => config_path('tron.php'),
		]);

		// Register commands
		$this->commands('command.tron.migration');

		// Register blade directives
		$this->bladeDirectives();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerTron();

		$this->registerCommands();

		$this->mergeConfig();
	}

	/**
	 * Register the blade directives
	 *
	 * @return void
	 */
	private function bladeDirectives()
	{
		// Call to Entrust::hasRole
		\Blade::directive('role', function($expression) {
			return "<?php if (\\Tron::hasRole{$expression}) : ?>";
		});

		\Blade::directive('endrole', function($expression) {
			return "<?php endif; // Tron::hasRole ?>";
		});

		// Call to Entrust::can
		\Blade::directive('permission', function($expression) {
			return "<?php if (\\Tron::can{$expression}) : ?>";
		});

		\Blade::directive('endpermission', function($expression) {
			return "<?php endif; // Tron::can ?>";
		});

		// Call to Entrust::ability
		\Blade::directive('ability', function($expression) {
			return "<?php if (\\Tron::ability{$expression}) : ?>";
		});

		\Blade::directive('endability', function($expression) {
			return "<?php endif; // Tron::ability ?>";
		});
	}

	/**
	 * Register the application bindings.
	 *
	 * @return void
	 */
	private function registerTron()
	{
		$this->app->bind('tron', function ($app) {
			return new Tron($app);
		});

		$this->app->alias('tron', 'Sammyboy45467\Tron\Tron');
	}

	/**
	 * Register the artisan commands.
	 *
	 * @return void
	 */
	private function registerCommands()
	{
		$this->app->singleton('command.tron.migration', function ($app) {
			return new MigrationCommand();
		});
	}

	/**
	 * Merges user's and entrust's configs.
	 *
	 * @return void
	 */
	private function mergeConfig()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/config.php', 'tron'
		);
	}

	/**
	 * Get the services provided.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'command.tron.migration'
		];
	}
}