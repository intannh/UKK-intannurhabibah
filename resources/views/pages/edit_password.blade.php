@extends('layout.edit_password')
@section('content2')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @endif
    <!--section-->
    <section class="max-w-[500px] mx-auto mt-36">
        <div class="max-[480px]:w-full">
            <form action="/updatepassword" method="POST">
                @csrf
                <div class="bg-white rounded-2xl shadow-xl ">
                    <div class="flex flex-col px-4 py-4 ">
                        <h5 class="text-3xl text-center font-caveat">Change Your Password</h5>
                        <h5 class="mt-4">Old Password</h5>
                        @error('password')
                            <small class="text-red-600 mt-2 text-sm">{{ $message }}</small>
                        @enderror
                        <input type="password" class="py-1 mt-1 border border-gray-200 rounded-md font-poppins"
                            name="current_password">
                        <h5 class="mt-4">New Password</h5>
                        @error('password')
                            <small class="text-red-600 mt-2 text-sm">{{ $message }}</small>
                        @enderror
                        <input type="password" class="py-1 mt-1 border border-gray-200 rounded-md font-poppins"
                            name="password">
                        <h5 class="mt-4">Confirm Password</h5>
                        @error('password')
                            <small class="text-red-600 mt-2 text-sm">{{ $message }}</small>
                        @enderror
                        <input type="password" class="py-1 mt-1 border border-gray-200 rounded-md font-poppins"
                            name="password_confirmation">
                        <button type="submit" class="py-2 mt-4 text-white rounded-md bg-blue-900">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--end section-->
    {{-- <script src="/node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
