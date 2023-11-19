<?php

namespace App\Livewire;

use App\Models\Student;
use Exception;

use Livewire\Component;

class ScanComponent extends Component
{
    public $scan_receiver;
    
    public function render()
    {
        $student = Student::where('student_osasid', 'like', '%' . $this->scan_receiver . '%' )->first();
        return view('livewire.scan-component', compact('student'));
    }
}
