@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main content --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="flex items-center  mb-4 rounded ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">
                                school
                            </span>
                            Scholarship
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- title + button container --}}
        <div class="flex flex-col items-center justify-center py-2 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Scholarship Programs
            </h2>
        </div>

        {{-- main content --}}
        <div class="mt-2 bg--300 gap-4 flex justify-end">
            {{-- for lg --}}
            <span class="flex gap-1">
                <span class="bg-gray-100 justify-center text-md p-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <div class="bg-white relative flex rounded-full">
                        <input type="text" class="lg:flex hidden rounded-full px-2 min-h-full focus:outline-none">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white rounded-full"
                            style="font-size: 16px">search</span>
                    </div>
                    <a href="" class="flex items-center">
                        <button class="px-2 lg:flex hidden rounded-full">Search</button>
                    </a>
                </span>
                <span class="bg-gray-100 justify-center text-md p-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <a href="{{ route('admin_create_scholarship') }}" class="flex items-center ">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white rounded-full"
                            style="font-size: 16px">add</span>
                        <span class="lg:flex hidden px-2 rounded-full">Add Scholarship</span>
                    </a>
                </span>
            </span>
        </div>
        <div class="bg--300 mt-2 mb-4 grid lg:grid-cols-3 md:grid-cols-2 gap-2 ">
            <div class="bg--300 border rounded-lg p-2 hover:shadow-md transition-all">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-rounded" style="font-size: 20px">school</span>
                    <h4 class="truncate">CHED Scholarship Program</h4>
                </div>
                <div class="flex mt-2 justify-end gap-1">
                    <span class="bg-gray-100  justify-center text-sm p-1 flex items-center rounded-full">
                        <span class="material-symbols-rounded p-1 bg-white rounded-full"
                            style="font-size: 16px">read_more</span>
                        <span class="  px-1 rounded-full">Details</span>
                    </span>
                    <span class="bg-gray-100  justify-center text-sm p-1 flex items-center rounded-full">
                        <span class="material-symbols-rounded p-1 bg-white rounded-full"
                            style="font-size: 16px">group</span>
                        <span class="  px-1 rounded-full">Grantees</span>
                    </span>
                </div>
            </div>

        </div>

    </div>
</div>
</div>

@include('partials.__footer')
