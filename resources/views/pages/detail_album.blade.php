@extends('layout.detail_album')
{{-- @push('cssjsexternal')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush --}}
@section('content2')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto">
            <h3 class="font-poppins text-2xl text-center">- Detail Album -</h3>
        </div>
    </section>
    <!--end section-->
    <!--section-->
    <section class="mt-10">
        <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
            <div class="flex flex-wrap items-center flex-container justify-center">
                {{-- <div class="flex mt-2 shadow-xl rounded-md transition duration-500 ease-in-out hover:scale-105 bg-white">
                    <div class="flex flex-col"> --}}

                    @foreach ($album->foto as $foto)
                    <div class="w-[363px] h-[192px] mt-2 px-2  mb-2">
                        <img class="mb-2 transition duration-500 ease-in-out hover:scale-105" src="/unggah/{{ $foto->lokasi_file }}" alt="{{ $foto->deskripsi }}">
                    </div>
                    @endforeach

                {{-- </div>
                </div> --}}

            </div>
        </div>
    </section>
    <!--end section-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
@endsection
{{-- @push('footerjsexternal')
      <script src="/javascript/exploredetail.js"></script>
  @endpush --}}
