@include('partials.__header')

{{-- external script for reading the qr code
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('js/my-script.js') }}"></script> --}}

<script type="text/javascript" src="/js/instascan.min.js"></script>

{{-- container for scanner preview --}}
<div class="relative flex items-center justify-center w-full bg-black min-h-screen min-w-screen">
    <div class=" z-50 absolute top-12 left-1/2 transform -translate-x-1/2 ">
        <h3 class="text-white">Event: {{ $event->event_name }}</h3>
    </div>
    <div
        class=" border-2 border-white w-7/12 h-2/6 md:w-5/12 lg:h-3/6 z-50 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">

    </div>
    <video class="min-h-screen min-w-screen" id="preview"></video>
</div>


{{-- for passing data --}}
<form action="{{ route('admin_procesqr') }}" method="POST" id="scanner_form">
    @csrf
    <input type="text" id="scanner" name="scanner" hidden>
</form>


{{-- script for qr code scanner --}}
<script type="text/javascript">
    // for broadcasting the video
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    // for getting the camera
    Instascan.Camera.getCameras()
        .then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        })
        .catch(function(e) {
            console.error(e);
        });
    // getting the value of qr code
    scanner.addListener('scan', function(c) {
        if (c) { // if value detected

            var regex = /^OWS-/;
            if (regex.test(c)) {
                var numericPart = parseInt(c.replace(/^OWS-/, ''), 10);
                document.getElementById('scanner').value = numericPart;
                document.getElementById('scanner_form').submit();
            } else {
                alert("Invalid OWS QR Code!");
            }
        }
    });
</script>

{{-- for handling the modal --}}
<script>
    window.onload = function() {
        // showModal();
    };

    function showModal() {
        // Get the modal element
        var modal = document.getElementById('popup-modal');
        // Display the modal
        modal.classList.remove('hidden');
    }
    // Add a function to hide the modal
    function hideModal() {
        // Get the modal element
        var modal = document.getElementById('popup-modal');
        // Hide the modal
        modal.classList.add('hidden');
    }
    // Add a click event listener to the modal close button
    var closeButton = document.querySelector('[data-modal-hide="popup-modal"]');
    if (closeButton) {
        closeButton.addEventListener('click', hideModal);
    }
</script>

@include('partials.__footer')
