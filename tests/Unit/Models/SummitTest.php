<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Summit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummitTest extends TestCase
{
    use RefreshDatabase;

    public function test_summit_belongs_to_user()
    {
        $user = User::factory()->create();
        $summit = Summit::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $summit->user);
    }

    public function test_duration_is_calculated_correctly()
    {
        $summit = Summit::factory()->create([
            'start_time' => now(),
            'end_time' => now()->addHours(2)
        ]);

        $this->assertEquals(120, $summit->duration);
    }
}
