<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div>
        <input type="text" hidden wire:model="searchTerm" id="scan_receiver" placeholder="Search...">

        <ul>
            @foreach ($students as $student)
                <li>{{ $student->student_osasid }}</li>
                <li>{{ $student->student_fname }}</li>
                <li>{{ $student->student_lname }}</li>
            @endforeach
        </ul>
    </div>
</div>
