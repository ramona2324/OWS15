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

    public function poll()
    {
        // Fetch the updated data from the database
        $this->admins = Admin::all();
    }
}
