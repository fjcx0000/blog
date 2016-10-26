<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AthomeTest extends TestCase
{
    /**
     * test athomes list
     *
     * @return void
     */
    public function testIndex()
    {
        $this->visit('athome')
                ->seeJsonStructure([
                    '*' => [
                        'id', 'led1', 'sensor1', 'sensor2', 'temperature'
                    ]
                ])
                ->seeJson(['created_at' => '2016-10-26 11:31:14', 'updated_at' => '2016-10-26 11:31:14']);
    }

    /**
     * test athome creation
     */
    public function testCreate()
    {
        $this->json('POST', 'athome', ['sensor1' => 12.5, 'sensor2' => 13.6, 'temperature' => 22.3, 'led1' => 1])
                ->seeJson(['sensor1' => 12.5, 'sensor2' => 13.6, 'temperature' => 22.3, 'led1' => 1]);
    }

}
