<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Menu extends Component
{

    public $Menu = false;

    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = request()->url();
    }

    public function render()
    {
        return view('livewire.menu');
    }

    public function openMenu()
    {
        $this->Menu = true;
    }

    public function closeMenu()
    {
        $this->Menu = false;
    }
}
