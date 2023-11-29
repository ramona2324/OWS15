@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">


    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main content --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="justify-between flex items-center  mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">local_activity</span>
                            Student Events
                        </a>
                    </li>

                </ol>
            </nav>

        </div>

        {{-- title + button container --}}
        <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Student Events
            </h2>
            {{-- for medium screens and up --}}
            <a href=" {{ route('admin_create_event') }} " class="block absolute right-8 md:right-10">
                <button type="submit"
                    class="hidden md:inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 ">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-red-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                    <h3 class="px-2">Add Event</h3>
                </button>
                {{-- for small screens --}}
                <button type="submit"
                    class="md:hidden  inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-red-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                </button>
            </a>
        </div>

        {{-- main content here --}}
        <div class=" mb-4 rounded ">

            @foreach ($student_events as $event)
                <a href="your_link_here"
                    class=" relative flex flex-wrap bg-red-400 justify-start border-box truncate h-20 w-full mb-2 pr-20 px-4 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm">
                    <div class="hidden md:flex mr-4 w-20 text-gray-400 h-full items-center    whitespace-normal">
                        <h4 class="h-full items-center flex  text-4xl ">3</h4>
                        <h4 class="font-wrap text-sm leading-3">days to go</h4>
                    </div>

                    <div class="w-full flex items-center ">
                        <h4 class="text-lg font-bold text-gray-700">{{ $event->event_name }}</h4>
                        <button type="button"
                            class="relative inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path
                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                            <span class="sr-only">Notifications</span>
                            Attendance
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                                8</div>
                        </button>
                    </div>

                    <div class="absolute px-4 bg-gray-200 h-full right-0 top-1/2  transform  -translate-y-1/2">
                        <form action=" {{ route('admin_event_scanner') }}" method="POST"
                            class="w-full h-full flex items-center justify-center">
                            @csrf
                            <input type="text" hidden name="event_id" value="{{ $event->event_id }}">
                            <button type="submit"
                                class="h-12 w-12 flex items-center justify-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm p-2">
                                <span class="material-symbols-rounded">
                                    qr_code_scanner
                                </span>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>


@include('partials.__footer')
