<?php
/**
 * Part of Windwalker project Test files.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Authentication\Test;

use Windwalker\Authentication\Authentication;
use Windwalker\Authentication\Credential;
use Windwalker\Authentication\Method\LocalMethod;

/**
 * Test class of LocalMethod
 *
 * @since 2.0
 */
class LocalMethodTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test instance.
	 *
	 * @var LocalMethod
	 */
	protected $instance;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$users = array(
			array(
				'username' => 'sakura',
				'password' => 'qwer'
			),
			array(
				'username' => 'flower',
				'password' => '1234'
			)
		);

		$this->instance = new LocalMethod($users);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * Method to test authenticate().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Authentication\Method\LocalMethod::authenticate
	 */
	public function testAuthenticate()
	{
		$this->instance->setVerifyHandler(function($pass, $hash)
		{
			return $pass == $hash;
		});

		$credential = new Credential(array('username' => 'flower', 'password' => '1234'));

		// Test success
		$this->assertTrue($this->instance->authenticate($credential));

		$this->assertEquals(Authentication::SUCCESS, $this->instance->getStatus());

		// Test invalid
		$credential->password = '5678';

		$this->assertFalse($this->instance->authenticate($credential));

		$this->assertEquals(Authentication::INVALID_CREDENTIAL, $this->instance->getStatus());

		// Test no user
		$credential->username = 'olive';

		$this->assertFalse($this->instance->authenticate($credential));

		$this->assertEquals(Authentication::USER_NOT_FOUND, $this->instance->getStatus());
	}

	/**
	 * Method to test getVerifyHandler().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Authentication\Method\LocalMethod::getVerifyHandler
	 * @TODO   Implement testGetVerifyHandler().
	 */
	public function testGetVerifyHandler()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * Method to test setVerifyHandler().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Authentication\Method\LocalMethod::setVerifyHandler
	 * @TODO   Implement testSetVerifyHandler().
	 */
	public function testSetVerifyHandler()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}
