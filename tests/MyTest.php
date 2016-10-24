<?php

/**
 * Created by PhpStorm.
 * User: think
 * Date: 22/10/2016
 * Time: 12:16 AM
 */
class MyTest extends TestCase
{
    /**
     * Test login form
     */
    public function testLoginForm()
    {
        $this->visit('/login')
                ->type('james.yang@heqs.com.au', 'email')
                ->type('123123', 'password')
                ->check('remember_me')
                ->press('Login')
                ->seePageIs('login')
                ->see('password error');
    }
    /**
     * Test Datagase
     */
    public function testDatabase()
    {
        $this->seeInDatabase('users', ['email' => 'james.yang@heqs.com.au']);
    }
}