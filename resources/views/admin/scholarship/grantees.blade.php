@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class="md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 85vh">

        {{-- navigation container --}}
        <div class=" justify-between flex items-center mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="" aria-label="Breadcrumb">
                <ol class=" items-center flex space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_scholarship') }}"
                            class="inline-flex items-center text-sm font-medium md:text-gray-500 text-gray-500 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">school</span>
                            <p class="max-w-28 truncate inline">Scholarship</p>
                        </a>
                    </li>
                    <li aria-current="page" class="hidden md:inline-flex items-center ">
                        <div class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium w-28 truncate text-gray-700 hover:text-blue-600 ">
                                {{ $scholarship->name }}
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- Previous Button -->
            <div class="flex">
                <a href=" {{ route('admin_scholarship') }}"
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

        {{-- title  --}}
        <div class="flex flex-col items-center justify-center py-2 rounded text-slate-800 ">
            <div>
                <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                    Scholarship Grantees
                </h2>
            </div>
        </div>

        {{-- buttons --}}
        <div class="mt-2 mb-4 bg--300 gap-4 flex justify-end">
            {{-- for lg --}}
            <span class="flex gap-1 bg--400">
                <span
                    class="bg-gray-100 justify-center p-1 md:gap-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <div class="bg-white relative p-0 flex items-center rounded-full">
                        <input type="text"
                            class="lg:flex m-0 text-sm hidden rounded-full  max-h-full p-1.5 focus:outline-none border-none focus:ring-none">
                    </div>
                    <a href="" class="flex items-center ">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white rounded-full"
                            style="font-size: 20px">search</span>
                        <button
                            class="px-2 lg:flex hidden font-medium text-gray-600 text-sm rounded-full">Search</button>
                    </a>
                </span>
                <a href="{{ route('admin_create_scholarship') }}"
                    class="bg-gray-100 justify-center max-h-fit text-md p-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <button class="flex items-center  focus:outline-none rounded-full ">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white  rounded-full"
                            style="font-size: 20px">add</span>
                        <span class="lg:flex hidden font-medium text-gray-600 text-sm px-2 rounded-full">
                            Add Grantee</span>
                    </button>
                </a>
            </span>
        </div>

        {{-- main content --}}
        <div class="bg--300 mt-2 mb-4 grid lg:grid-cols-3 md:grid-cols-2 gap-2 ">
            @foreach ($student_grantees as $student_grantee)
                <div class="bg--300 border text-gray-600 rounded-lg p-2 hover:shadow-md transition-all">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-rounded" style="font-size: 20px">school</span>
                        <h4 class="truncate font-medium">{{ $student_grantee->fname }}</h4>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>


@include('partials.__footer')
