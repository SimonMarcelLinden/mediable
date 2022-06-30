<?php

if (!function_exists('config_path')) {
	/**
	 * Return the path to config files
	 * @param null $path
	 * @return string
	 */
	function config_path($path = null) {
		return app()->getConfigurationPath(rtrim($path, ".php"));
	}
}

if (!function_exists('public_path')) {

	/**
	 * Return the path to public dir
	 * @param null $path
	 * @return string
	 */
	function public_path($path = null) {
		// return app()->make('path.public').($path ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : $path);
		return rtrim(app()->basePath('public/' . $path), '/');
	}
}

if (!function_exists('storage_path')) {

	/**
	 * Return the path to storage dir
	 * @param null $path
	 * @return string
	 */
	function storage_path($path = null) {
		return app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
		// return app()->storagePath($path);
	}
}

if (!function_exists('database_path')) {

	/**
	 * Return the path to database dir
	 * @param null $path
	 * @return string
	 */
	function database_path($path = null) {
		return app()->databasePath($path);
	}
}

if (!function_exists('resource_path')) {

	/**
	 * Return the path to resource dir
	 * @param null $path
	 * @return string
	 */
	function resource_path($path = null) {
		return app()->resourcePath($path);
	}
}

if (!function_exists('asset')) {
	/**
	 * Generate an asset path for the application.
	 *
	 * @param  string  $path
	 * @param  bool    $secure
	 * @return string
	 */
	function asset($path, $secure = null) {
		return app('url')->asset($path, $secure);
	}
}

