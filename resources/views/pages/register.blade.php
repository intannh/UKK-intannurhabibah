@extends('layout.register')
@section('content')
    <!--section register-->
    <br>
    <br>
    <section class="mt-14">
        @if (session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @endif
        <div class="bg-white shadow-xl rounded-md mx-auto px-6 py-8 max-w-[364px]">
            <form action="registered" method="POST">
                @csrf
                <div class="flex flex-col">
                    <h3 class="mx-auto text-2xl font-logo"><a href="index.html">i - gallery</a></h3>
                    <h4 class="mt-8">Email</h4>
                    <input type="text" class="mt-1 px-4 py-1 rounded-md text-slate-700 border border-gray-300"
                        placeholder="Email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-red-600 text-xs">{{ $message }}</small>
                    @enderror
                    <h4 class="mt-2">Username</h4>
                    <input type="text" class="mt-1 px-4 py-1 rounded-md text-slate-700 border border-gray-300"
                        placeholder="Username" name="username" value="{{ old('username') }}">
                    @error('username')
                        <small class="text-red-600 text-xs">{{ $message }}</small>
                    @enderror
                    <h4 class="mt-2">Password</h4>
                    <input type="password" class="mt-1 px-4 py-1 rounded-md text-slate-700 border border-gray-300"
                        placeholder="Password" name="password">
                    @error('password')
                        <small class="text-red-600 text-xs">{{ $message }}</small>
                    @enderror

                    <button type="submit"
                        class="py-1 mt-4 text-center text-white bg-blue-900 rounded-full font-poppins">Register</button>
                    <h3 class="mx-auto text-xs mt-4">Already a member? <a href="/login" class="text-blue-900">Log
                            in</a>
                    </h3>
                </div>
            </form>
        </div>
    </section>
    <!--end section register-->
@endsection
