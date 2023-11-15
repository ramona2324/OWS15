@include('partials.__header')

@include('partials.__student_sidebar')

{{-- right side section --}}
<div class="md:ml-60">

    {{-- reusable page header --}}
    @include('partials.__student_pageheader')

    {{-- main content --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="flex items-center  mb-4 rounded ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">dashboard</span>
                            Dashboard
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- 3 cols div --}}
        <div class="md:grid grid-cols-3 gap-4 mb-4 md:p-4 p-2 border rounded-lg">
            <div class="p-4 justify-center text-gray-600 align-middle flex flex-col">
                <p class=" text-md">
                    School Year: 2023-2024
                </p>
                <p class=" text-md">
                    Semester: 2nd
                </p>
            </div>
            <div
                class="p-4 items-center flex-column items-center justify-center text-center rounded-xl border-4 border-yellow-200">
                <div class="w-full justify-center flex">
                    @if (Auth::check() && Auth::user()->student_picture)
                        <img src="{{ Auth::user()->student_picture }}" />
                    @else
                        <img src="https://api.dicebear.com/7.x/initials/svg?seed=" />
                    @endif
                </div>

                <div class="text-slate-600 mt-2">
                    @if (Auth::check())
                        <span class="block text-lg font-bold  ">{{ Auth::user()->student_fname }}
                            {{ Auth::user()->student_lname }}</span>
                        <span class="block text-md truncate ">{{ Auth::user()->email }}</span>
                        <p class="text-sm"> {{ Auth::user()->Course->course_name }} </p>
                    @else
                        <p>You are not logged in.</p>
                    @endif

                </div>
            </div>
            <div class="p-4 justify-center items-center flex flex-col">
                <button type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">
                    Create QR CODE
                </button>
                @auth
                    <div id="qrcode-container">
                        {{-- Content will be dynamically loaded here --}}
                    </div>
                @else
                    <p>You are not logged in.</p>
                @endauth
            </div>
        </div>

    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {

        // Ajax request to get QR code data
        $.ajax({
            url: "{{ route('display_qr') }}",
            method: 'GET',
            success: function (response) {
                // Check for errors in the response
                if (response.error) {
                    console.log('AJAX request successful:', response);
                    $('#qrcode-container').html('<p>' + response.error + '</p>');
                } else {
                    // Update the container with the QR code filename
                    $('#qrcode-container').html('<span class="block text-md truncate">' + response.qrcode_filename + '</span>');
                }
            },
            error: function (error) {
                console.log('AJAX request failed:', error);
                // Handle errors if the Ajax request fails
                $('#qrcode-container').html('<p>An error occurred while fetching the QR code data.</p>');
            }
        });
    });
</script>

@include('partials.__footer')
