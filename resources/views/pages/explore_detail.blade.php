@extends('layout.explore_detail')
@push('cssjsexternal')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('content2')
    <!--section-->
    <section class="mt-28">
        @csrf
        <div class="max-w-screen-md mx-auto shadow-md rounded-2xl">
            <div class="flex flex-wrap flex-container px-2 mt-2">
                <div class="w-3/5 max-[480px]:w-full">
                    <div class="flex justify-center overflow-hidden mt-3">
                        <!--foto-->
                        <img src="" alt="" class="w-full h-auto max-w-xl px-2" id="fotodetail" />
                    </div>
                    <div class="flex flex-col">
                        <!--judulfoto-->
                        <div class="font-semibold font-poppins mt-2 ml-2" id="judulfoto"></div>
                        <div class="mb-2 ml-2">
                            <!--deskripsifoto-->
                            <small class="text-gray-400 font-poppins" id="deskripsifoto"></small>
                        </div>
                    </div>
                </div>
                <!--komen-->
                <div class="w-2/5 max-[480px]:w-full">
                    <div class="flex flex-wrap items-center justify-between mt-3">
                        <div class="flex flex-row items-center gap-2">
                            <div class="flex items-center mt-1">
                                <!--foto profil user-->
                                <img src="" class="w-10 h-10 rounded-full" alt="" id="fotoprofil" />
                            </div>
                            <div class="flex flex-col">
                                <a href="/other_profile/{{ $foto->user_id }}" class=" font-poppins" id="username"></a>
                                <small class="text-xs" id="jumlahpengikut"></small>
                            </div>
                        </div>
                        <div id="tombolfollow">
                            <button class="px-4 rounded-full bg-blue-600"></button>
                        </div>
                    </div>
                    @csrf
                    <div class="mt-[25px] font-poppins">Comments</div>
                    <div class="flex flex-col overflow-y-auto h-[200px] scrollbar-hidden relative" id="komentar">
                        {{-- <div class="flex flex-row justify-start mt-4">
                            <div class="w-1/4">
                                <img src="/assets/gambar_5.JPG" class="w-8 h-auto rounded-full" alt="" />
                            </div>
                            <div class="flex flex-col mr-2">
                                <h5 class="text-sm font-poppins">habibeh</h5>
                                <small class="text-xs text-gray-400">14w</small>
                            </div>
                            <h5 class="text-sm font-poppins">woiii</h5>
                        </div> --}}
                    </div>
                    <div class="flex gap-2 mt-2">
                        <div class="w-3/4">
                            <input type="text" name="textkomentar" id=""
                                class="w-full px-2 py-1 rounded-full border-slate-500" placeholder="Tulis Comment...">
                        </div>
                        <button class="px-4 rounded-full bg-blue-800" onclick="kirimkomentar()"><span
                                class="text-white bi bi-send"></span></button>
                    </div>
                    <!--end komen-->
                </div>
            </div>
    </section>
    <!--end section-->

    <!--section bawah-->
    <section class="mt-10">
        @csrf
        <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
            <div class="flex flex-wrap flex-container items-center justify-center gap-3" id="exploredatapostingan">
                <!--postinganpublic-->
                {{-- <div class="mt-2">
                    <div class="felx flex-col px-2">
                        <div
                            class="w-[360px] h-[192px] overflow-hidden transition duration-500 ease-in-out hover:scale-105">
                            <a href="explore_detail.html">
                                <img src="/assets/gambar_1.jpg" alt="" class="w-full rounded-md">
                            </a>
                        </div>
                        <div class="flex flex-wrap items-center justify-between mt-2">
                            <div>
                                <div class="flex">
                                    <img src="/assets/sipa.jpeg" alt="" class="w-8 h-8 rounded-full">
                                    <div class="flex flex-col px-2">
                                        <a href="other_profile.html"><span class="font-poppins">syifanuraini</span></a>
                                        <span class="text-xs text-gray-300">14w</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="bi bi-chat"></span>
                                <span class="bi bi-heart"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!--end section bawah-->
    {{-- {{-- <script src="/node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
    <script src="/javascript/exploredetail.js"></script>
@endpush
