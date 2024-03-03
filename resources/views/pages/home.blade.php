@extends('layout.home')
@push('cssjsexternal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('content2')
    <section class="mt-32">
        <div class="items-center max-w-screen-md mx-auto">
            {{-- <h3 class="font-roboto text-xl text-center">February 19, 2024</h3> --}}
            <h3 class="font-poppins text-4xl text-center">Stay Inspired</h3>
        </div>
    </section>
    <!--end section-->
    <!--section-->
    <section class="mt-10">
        @csrf
        <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
            <div class="flex flex-wrap flex-container items-center justify-center gap-3" id="exploredata">
                {{-- <div class="mt-2">
                    <div class="felx flex-col px-2">
                        <div
                            class="w-[360px] h-[192px] overflow-hidden transition duration-500 ease-in-out hover:scale-105">
                            <a href="/explore_detail">
                                <img src="/assets/gambar_1.jpg" alt="" class="w-full rounded-md" />
                            </a>
                        </div>
                        <div class="flex flex-wrap items-center justify-between mt-2">
                            <div>
                                <div class="flex">
                                    <img src="/assets/sipa.jpeg" alt="" class="w-8 h-8 rounded-full" />
                                    <div class="flex flex-col px-2">
                                        <a href="/other_profile"><span class="font-poppins">syifanuraini</span></a>
                                        <span class="text-xs text-gray-300">14w</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="bi bi-chat"></span>
                                <small>1</small>
                                <span class="bi bi-heart"></span>
                                <small>2</small>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script> --}}

@endsection
@push('footerjsexternal')
<script src="/javascript/explore.js"></script>
@endpush
