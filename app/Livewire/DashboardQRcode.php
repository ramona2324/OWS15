<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardQRcode extends Component
{
    public $studentQrCode;

    // mounting data
    public function mount()
    {
        if (Auth::check()) {
            $this->studentQrCode = \App\Models\QRCode::where('student_osasid', Auth::user()->student_osasid)->first();
        }
    }

    // renderer of the view
    public function render()
    {
        return view('livewire.dashboard-q-rcode');
    }

    // fetching dynamic data
    public function poll()
    {
        if (Auth::check()) {
            $this->studentQrCode = \App\Models\QRCode::where('student_osasid', Auth::user()->student_osasid)->first();
        }
    }

}
