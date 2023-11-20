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
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">how_to_reg</span>
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
            <a href="  " class="block absolute right-8 md:right-10">
                <button type="submit"
                    class="hidden md:inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                    <h3 class="px-2">Add Event</h3>
                </button>
                {{-- for small screens --}}
                <button type="submit"
                    class="md:hidden  inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                </button>
            </a>
        </div>

        <div class=" flex bg-red-500 flex-col items-center mb-4 rounded ">

            <a href=" "
                class="flex justify-start border-box truncate w-full mb-2 p-2 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm ">
                <div class="bg-blue-500 w-48">
                    <h4>days to go</h4>
                </div>
                <div class="bg-yellow-500 w-full">
                    <h4>This is the Title</h4>
                </div>
                <button type="button"
                    class=" focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ">
                    View Details
                </button>
            </a>


        </div>
    </div>

</div>


@include('partials.__footer')
