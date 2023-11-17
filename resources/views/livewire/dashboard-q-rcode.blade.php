<div wire:poll.1000ms>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    @if ($studentQrCode)
        <span class="block text-md truncate">{{ $studentQrCode->qrcode_filename }}</span>
    @else
        <button type="button"
            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">
            Create QR CODE
        </button>
    @endif

</div>
