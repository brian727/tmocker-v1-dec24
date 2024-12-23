<?php

namespace App\Livewire;

use App\Models\Summit;
use Livewire\Component;
use Livewire\WithPagination;

class MySummits extends Component
{
    public function render()
    {
        return view('livewire.my-summits', [
            'summits' => auth()->user()
                ->summits()
                ->latest()
                ->paginate(10)
        ]);
    }
}
