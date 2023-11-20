@include('partials.__header')

{{-- modal --}}
<div  tabindex="-1"
    class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative flex items-center justify-center p-4 w-full  min-h-screen bg-opacity-50 bg-gray-900">
        <div class="relative bg-white w-1/2 rounded-lg shadow ">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-6 text-center">
                <h3 class="mb-5 text-lg font-bold text-gray-600 ">
                    Confirm Attendance?
                </h3>



                <div class="flex mt-6 gap-4 text-center">
                    <button data-modal-hide="popup-modal" type="button"
                        class="text-gray-500 w-1/2 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">
                        DENY
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="text-white w-1/2 bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                        CONFIRM
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.__footer')
