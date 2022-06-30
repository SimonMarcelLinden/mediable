<?php

namespace SimonMarcelLinden\Mediable;

use Illuminate\Support\ServiceProvider;

class MediableServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot(): void {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register(): void {}
}
