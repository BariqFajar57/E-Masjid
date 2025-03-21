<?php

namespace App\Http\Livewire;

use App\Models\ProfileMasjid;
use Livewire\Component;

class HomeVisiMisi extends Component
{
    public $readyToLoad;

    public function mount()
    {
        $this->readyToLoad = false;
    }

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.home-visi-misi', [
            'data' => $this->readyToLoad ? ProfileMasjid::select('visi_misi')->first() : [],
        ]);
    }
}
