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
        <div class="mt-2 bg--300 flex justify-end">
            <span class="flex gap-1">
                <span class="bg-gray-100 text-red-900 p-1 flex items-center rounded-full">
                    <span class="material-symbols-rounded" style="font-size: 20px">search</span>
                </span>
                <span class="bg-gray-100 text-red-900 p-1 flex items-center rounded-full">
                    <span class="material-symbols-rounded" style="font-size: 20px">add</span>
                </span>
            </span>
        </div>
        <div class="bg--300 mt-2 mb-4 grid lg:grid-cols-3 md:grid-cols-2 gap-2 ">
            <div class="bg--300 border rounded-lg p-2">
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
