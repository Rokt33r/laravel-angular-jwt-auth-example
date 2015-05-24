<?php

use App\User;

class AuthTest extends TestCase {

	public function testAttempt()
	{
		$user = User::where('email', 'testcat@example.com')->first();
		if(is_null($user)) User::create([
			'name'=>'Test Cat',
			'email'=>'testcat@example.com',
			'password'=>bcrypt('secret')
		]);

		$response = $this->call('POST', "/auth", ['email'=>$user->email, 'password'=>'secret']);

		$this->matchJson($response->getContent(), '$.token');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testCheck()
	{
		$user = User::where('email', 'testcat@example.com')->first();
		if(is_null($user)) User::create([
			'name'=>'Test Cat',
			'email'=>'testcat@example.com',
			'password'=>bcrypt('secret')
		]);

		$response = $this->authCall($user, 'GET', "/auth");

		$this->matchJson($response->getContent(), '$.user');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testProtected()
	{
		$response = $this->call('GET', "/protected");

		$this->assertEquals(400, $response->getStatusCode());
	}

}
