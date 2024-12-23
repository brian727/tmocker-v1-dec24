<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Summittracker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummitTrackerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_start_summit()
    {
        $user = User::factory()->create();
        
        Livewire::actingAs($user)
            ->test(Summittracker::class)
            ->set('latitude', 32.252010767508445)
            ->set('longitude', -110.93584885508393)
            ->call('start')
            ->assertSet('isTracking', true);
    }

    public function test_user_can_complete_summit()
    {
        $user = User::factory()->create();
        
        Livewire::actingAs($user)
            ->test(Summittracker::class)
            ->set('isTracking', true)
            ->set('startTime', now())
            ->set('temp', 75)
            ->set('latitude', 32.252010767508445)
            ->set('longitude', -110.93584885508393)
            ->call('stop')
            ->assertHasNoErrors()
            ->assertSet('showLeaderboard', true);
    }
}
