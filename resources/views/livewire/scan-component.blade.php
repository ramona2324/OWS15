<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="flex flex-col items-center justify-center text-gray-600">
        <input type="text" wire:model.live="scan_receiver" hidden id="scan_receiver" >
        @if ($student)
            <img class="rounded-full border" src="{{ $student->student_picture ?? '' }}" >
            <h3 class="font-bold mt-2">
                <span> {{ $student->student_fname ?? '' }} </span>
                <span> {{ $student->student_lname ?? '' }} </span>
            </h3>
            <h4>{{ $student->email ?? '' }}</h4>
            <h4>{{ $student->course->course_name ?? '' }}</h4>
        @else
            <p>No student found</p>
        @endif
    </div>
</div>
