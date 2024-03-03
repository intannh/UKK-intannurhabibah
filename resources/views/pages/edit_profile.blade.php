@extends('layout.edit_profile')
@section('content2')
    <!--section-->
    <section class="max-w-screen-md mx-auto mt-36">
        <form action="/ubahprofil" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap justify-between flex-container">
                <div class="flex flex-col items-center w-2/6 bg-white rounded-md shadow-md max-[480px]:w-full">
                    <img src="/unggah/{{ old('pictures', Auth::User()->pictures) }}" alt=""
                        class="rounded-full w-36 h-36" />
                    <input type="file" name="file" class="items-center w-48 h-10 mt-4 border rounded-md" />
                    <button type="submit" class="w-48 py-1 mt-4 text-white rounded-full bg-blue-900">
                        Ubah Photo
                    </button>
                </div>
        </form>
        <div class="w-3/5 max-[480px]:w-full">
            <div class="bg-white rounded-2xl shadow-xl">
                <form action="/updateprofile" method="POST">
                    @csrf
                    <div class="flex flex-col px-4 py-4">
                        <h5 class="text-3xl text-center font-caveat">Your Profile</h5>
                        <h5 class="mt-4">Nama Lengkap</h5>
                        <input type="text" class="py-1 border border-gray-200 rounded-md" name="nama_lengkap"
                            value="{{ $dataprofile->nama_lengkap }}" />
                        <h5 class="mt-4">Username</h5>
                        <input type="text" class="py-1 border border-gray-300 rounded-md" name="username"
                            value="{{ $dataprofile->username }}" />
                        <h5 class="mt-4">Email</h5>
                        <input type="text" class="py-1 border border-gray-300 rounded-md" name="email"
                            value="{{ $dataprofile->email }}" />
                        <h5 class="mt-4">No Telepon</h5>
                        <input type="text" class="py-1 border border-gray-300 rounded-md" name="no_telepon"
                            value="{{ $dataprofile->no_telepon }}" />
                        <h5 class="mt-4">Alamat</h5>
                        <textarea type="text" class="py-1 border h-28 border-gray-300 rounded-md" name="alamat">
                                {{ $dataprofile->alamat }}
              </textarea>
                        <h5 class="mt-4">Bio</h5>
                        <textarea type="text" class="py-1 border h-14 border-gray-300 rounded-md" name="bio">
                                {{ $dataprofile->bio }}
              </textarea>
                        <button type="submit" class="py-2 mt-4 text-white rounded-full bg-blue-800">
                            Simpan
                        </button>
                    </div>
            </div>
        </div>
        </form>
        </div>
    </section>
    <!--end section-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
