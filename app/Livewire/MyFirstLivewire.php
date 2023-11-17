<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Admin;

class MyFirstLivewire extends Component
{
    public $admins;

    public function mount()
    {
        $this->admins = Admin::all();
    }

    public function render()
    {
        return view('livewire.my-first-livewire');
    }
}
