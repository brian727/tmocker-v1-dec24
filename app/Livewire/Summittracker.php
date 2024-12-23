<?php

namespace App\Livewire;

use App\Models\Summit;
use Livewire\Component;
use Illuminate\Support\Facades\Date;

class Summittracker extends Component
{   
    const START_LATITUDE = 32.252010767508445;  // Replace with actual start coordinates
    const START_LONGITUDE = -110.93584885508393;
    const END_LATITUDE = 32.252010767508445;    // Replace with actual end coordinates
    const END_LONGITUDE = -110.93584885508393;


    const ALLOWED_RADIUS = 0.1;  // km

    public $isTracking = false;
    public $startTime = null;
    public $temp = null;
    public $latitude = null;
    public $longitude = null;

    public $showLeaderboard = false;

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    }

    public function setLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    public function start() 
    {
        if (!$this->isValidLocation(
            $this->latitude,
            $this->longitude,
            self::START_LATITUDE,
            self::START_LONGITUDE
        )) {
            $this->dispatch('showError', 'You must be at the starting location.');
            return;
        }

    $this->isTracking = true;
    $this->startTime = now();
    $this->dispatch('summitStarted', $this->startTime);
}

    public function stop() 
    {
        if (!$this->isValidLocation(
            $this->latitude,
            $this->longitude, 
            self::END_LATITUDE, 
            self::END_LONGITUDE
        )) {
            $this->dispatch('showError', 'You must be at the summit.');;
            return;
        }

        if($this->isTracking) {
            auth()->user()->summits()->create([
                'start_time' => $this->startTime,
                'end_time' => now(),
                'temp' => $this->temp
            ]);

            $this->showLeaderboard = true;
            session()->flash('message', 'Summit recorded successfully!');
            $this->reset(['isTracking', 'startTime', 'temp', 'latitude', 'longitude']);
        }
    }

    private function isValidLocation($latitude, $longitude, $targetLat, $targetLng)
    {
        $earthRadius = 6371; // km
        
        $latDiff = deg2rad($latitude - $targetLat);
        $lngDiff = deg2rad($longitude - $targetLng);
        
        $a = sin($latDiff/2) * sin($latDiff/2) +
             cos(deg2rad($targetLat)) * cos(deg2rad($latitude)) *
             sin($lngDiff/2) * sin($lngDiff/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;
        
        return $distance <= self::ALLOWED_RADIUS;
    }

    public function render()
    {
        return view('livewire.summittracker', [
            'summits' => auth()->user()->summits()->latest()->get()
        ]);
    }
}