<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	use TestHelpersTrait;
	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

	public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
	{
		$server['HTTP_Accept'] = 'application/json, text/plain, * / *';

		$method = strtoupper($method);
		if($method == 'POST'|| $method == 'PUT') $server['HTTP_Content_Type'] = 'application/json';

		return parent::call($method, $uri, $parameters, $cookies, $files, $server, $content);
	}

}
