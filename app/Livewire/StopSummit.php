<?php

namespace App\Livewire;

use Livewire\Component;

class StopSummit extends Component
{
    public $startSummit;

    protected $listeners = ['summitStarted' => 'handleSummitStarted'];

    public function handleSummitStarted($startTime)
    {
        $this->startSummit = $startTime;
    }

    public function stopSummit() {
        //stop timer
        //store stop value into summit object
        //pass along success message
        //redirect to leaderboard position
    }

    public function render()
    {
        return view('livewire.stop-summit');
    }
}
