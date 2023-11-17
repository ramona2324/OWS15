<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <h1>Present Admins</h1>

    <ul>
        @foreach($admins as $admin)
            <li>{{ $admin->admin_fname }}</li>
        @endforeach
    </ul>

</div>


