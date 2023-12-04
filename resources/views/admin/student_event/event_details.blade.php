@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class=" md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="p-4 mx-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 85vh">

        {{-- navigation container --}}
        <div class=" justify-between flex items-center mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="" aria-label="Breadcrumb">
                <ol class=" items-center flex space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_stud_events') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">how_to_reg</span>
                            Student Events
                        </a>
                    </li>
                    <li aria-current="page" class="hidden md:inline-flex items-center ">
                        <div class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium text-gray-700 hover:text-blue-600 ">
                                @foreach ($records as $record)
                                    {{ $record->event->event_name }}
                                @break
                            @endforeach
                        </p>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex">
            <!-- Previous Button -->
            <a href=" {{ route('admin_stud_events') }}"
                class="flex items-center justify-center px-3 h-8  text-sm font-medium text-gray-500 bg-white  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                back
            </a>
        </div>
    </div>

    {{-- title + button container --}}
    <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
        <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
            @foreach ($records as $record)
                {{ $record->event->event_name }}
            @break
        @endforeach
    </h2>
</div>

{{-- main content --}}
<div
    class="bg--100 relative flex justify-start border-box truncate w-full mb-2 p-2 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm">
    {{-- first column --}}
    <div class="hidden md:flex bg--100 w-30 text-gray-400 min-h-full items-center    whitespace-normal">
        <h4 class="h-full items-center flex text-5xl text-yellow-400 ">
            </h4>
        <h4 class="font-wrap text-sm leading-3">days to go</h4>
    </div>
    {{-- second column --}}
    <div class="w-full bg--100 md:items-center flex flex-col mr-2 truncate">
        <div class=" h-full items-center flex">
            <a href=" ">
                <h4 class="text-md text-gray-700 truncate"></h4>
            </a>
        </div>
        <div class="flex gap-1 mt-2">
            <p class="text-xs text-gray-700 bg-yellow-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                <span class="material-symbols-rounded" style="font-size: 15px">
                    event
                </span>
                
            </p>
            <p class="text-xs text-gray-700 bg-gray-100 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                <span class="material-symbols-rounded" style="font-size: 15px">
                    schedule
                </span>
                
            </p>
        </div>
    </div>
    {{-- third column --}}
    <div class="flex bg--100 gap-2 items-center">
        {{-- qr button --}}
        <a href=" "
            class="w-full py-2 bg-green-300 flex items-center justify-center rounded-md">
            <button type="submit"
                class="h-6 md:w-32 flex gap-1 items-center justify-center font-medium rounded-full p-2 ">
                <span class="material-symbols-rounded" style="font-size: 20px">
                    qr_code_scanner
                </span>
                <p class="text-sm text-gray-700 hidden md:block">
                    Scan
                </p>
            </button>
        </a>
    </div>
</div>
{{-- old content --}}
<div class="flex flex-row mt-2 mb-4 gap-4">
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Student</th>
                <th>Date</th>
                <th>Time</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->event->event_name }}</td>
                    <td>{{ $record->student->student_fname }}</td>
                    <td>{{ $record->last_created_date }}</td>
                    <td>{{ $record->last_created_time }}</td>
                    <!-- Add more columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>


@include('partials.__footer')
