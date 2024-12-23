<?php

namespace App\Livewire;

use App\Models\Summit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Leaderboard extends Component
{
    use WithPagination;
    public $perPage = 10;
    
    public function render()
    {
        //FOR MYSQL
        // return view('livewire.leaderboard', [
        //     'summits' => Summit::with('user')
        //         ->select('summits.*')
        //         ->selectRaw('TIMESTAMPDIFF(MINUTE, start_time, end_time) as duration')
        //         ->orderBy('duration', 'asc')
        //         ->paginate($this->perPage)
        // ]);
        return view('livewire.leaderboard', [
            'summits' => Summit::with('user')
                ->select('summits.*')
                ->selectRaw('ROUND((julianday(end_time) - julianday(start_time)) * 24 * 60) as duration')
                ->orderBy('duration', 'asc')
                ->paginate($this->perPage)
        ]);
    }
}
