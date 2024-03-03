@extends('layout.upload')
@push('cssjsexternal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('content2')
    <!--section-->
    <section class="mt-36">
        <div class="max-w-screen-md mx-auto shadow-md">
            <div class="flex flex-wrap px-2 flex-container">
                <div class="w-3/5 max-[480px]:w-full">
                    <form action="/unggah_foto" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-center px-3">
                            <div class="flex items-center justify-center w-full">
                                {{-- <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"> --}}
                                    {{-- <div class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"> --}}
                                        <div class="flex flex-col items-center justify-center pt-2 pb-3">
                                        <div class="flex justify-center px-3">
                                            <div class="flex items-center justify-center w-full">
                                                <div class="container1">
                                                    <input type="file" id="file" accept="image/*" name="filefoto" hidden />
                                                    <div class="img-area select-image" data-img="">
                                                        <span class="bi-cloud-upload-fill icon"></span>
                                                        <h3>Upload Image</h3>
                                                        <p>Ukuran Gambar Harus Kurang Dari<span>2MB</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 800x400px)
                                        </p>
                                    </div> --}}
                                    <input id="dropzone-file" type="file" class="hidden" name="file" />
                                </label>
                            </div>
                        </div>

                </div>
                <div class="w-2/5  max-[480px]:w-full px-2 h-[300px]">
                    <div class="flex flex-col flex-wrap">
                        <h3 class="font-poppins">Judul</h3>
                        <input type="text" name="judul_foto" id=""
                            class="py-1 rounded-full border border-gray-300">
                        <h3 class="mt-4 font-poppins">Deskripsi</h3>
                        <input type="text" name="deskripsi_foto" id="" cols="30" rows="10"
                            class="w-full border border-gray-300 rounded-full"></input>
                        <h3 class="mt-4 font-poppins">Album</h3>
                        <div class="flex flex-row">
                            <select type="text" name="nama_album" id="" cols="30" rows="10"
                                class="w-full border border-gray-300 rounded-full text-gray-400">
                                <option value="" selected class="text-gray-300 hidden">choose album</option>
                                @foreach ($data_album as $item)
                                    @if ($item->user_id == auth()->user()->id)
                                        <option value="{{ $item->id }}"> {{ $item->nama_album }}</option>
                                    @endif
                                @endforeach

                            </select>
                            <a href="/tambah_album"><button type="button" class="border h-full px-3 ml-2"><span
                                        class="bi bi-plus"></span></button></a>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div></div>
                            <button type="submit"
                                class="px-6 py-1 mt-4 w-full text-white rounded-full bg-blue-800">Post</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--end section-->
    {{-- <script src="/node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    {{-- <script src="/node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
<script src="/javascript/upload.js"></script>
@endpush
