@extends('layout.tambah_album')
@section('content2')
    <!--section-->
    <section class="max-w-[500px] mx-auto mt-36">
        <div class="max-[480px]:w-full">
            <form action="/tambah_album" method="POST">
                @csrf
                <div class="bg-white rounded-2xl shadow-xl ">
                    <div class="flex flex-col px-4 py-4 ">
                        <h5 class="text-3xl text-center font-caveat">Tambah Album</h5>
                        <h5 class="mt-4 font-poppins" name="nama_album" id="nama_album">Nama Album</h5>
                        <input type="text" class="w-full border border-gray-300 rounded-full mt-1" name="nama_album">
                        <button type="submit" class="py-2 mt-4 text-white rounded-md bg-blue-900">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--end section-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
