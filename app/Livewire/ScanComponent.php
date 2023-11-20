<?php

namespace App\Livewire;

use App\Models\Student;
use Exception;

use Livewire\Component;

class ScanComponent extends Component
{
    public $scan_receiver; // this gets the data from the input in view
    
    public function render() // for rendering the view
    {
        $student = Student::where('student_osasid', 'like', '%' . $this->scan_receiver . '%' )->first();
        return view('livewire.scan-component', compact('student'));
    }
}
