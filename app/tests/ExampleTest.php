<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Laravel 9');
    }

    /**
     * @test
     *
     * Test: GET /api.
     */
    public function it_praises_the_fruits()
    {
        $this->get('/api')
            ->seeJson([
                'Fruits' => 'Delicious and healthy!',
            ]);
    }
}
