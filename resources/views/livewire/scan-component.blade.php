<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div>
        
        <input type="text" wire:render.1000 wire:model="scan_receiver" hidden id="scan_receiver" value="">

        @if ($student)
            {{-- Assuming your Student model has properties like 'student_fname', 'student_lname', etc. --}}
            <p>Name: {{ $student->student_fname ?? '' }}</p>
            <p>Last name: {{ $student->student_lname ?? '' }}</p>
            {{-- Add more details as needed --}}
        @else
            <p>No student found</p>
        @endif

    </div>
</div>
