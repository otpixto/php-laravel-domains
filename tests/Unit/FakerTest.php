<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FakerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function faker_is_failing(): void
    {
        $count = 90;

        for ($i = 0; $i < $count; $i++) {
            $data[$this->faker->unique()->word()] = User::factory()->make();
        }

        $this->assertCount($count, $data);
    }
}
