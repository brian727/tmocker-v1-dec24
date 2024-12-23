<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Summit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Create users first
            $users = User::factory(20)->create();
            
            // Create summits with error handling
            foreach(range(1, 40) as $index) {
                $startTime = Carbon::now()->subDays(rand(1, 30));
                
                Summit::create([
                    'user_id' => $users->random()->id,
                    'start_time' => $startTime,
                    'end_time' => (clone $startTime)->addMinutes(rand(30, 120)),
                    'temp' => rand(60, 90)
                ]);
            }

            Log::info('Seeding completed', [
                'users' => User::count(),
                'summits' => Summit::count()
            ]);

        } catch (\Exception $e) {
            Log::error('Seeding failed', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
