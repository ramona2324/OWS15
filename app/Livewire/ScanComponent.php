<?php

namespace App\Livewire;
use App\Models\Student;

use Livewire\Component;

class ScanComponent extends Component
{
    public $searchTerm;

    public function render()
    {
        $student = Student::where('student_osasid', 'like', '%' . $this->searchTerm . '%')->get();
        return view('livewire.scan-component', ['students' => $student]);
    }
}
