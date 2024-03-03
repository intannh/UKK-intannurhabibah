@extends('layout.index')
@section('content')
    <section class="mt-20">
        <h1 class="font-caveat text-[60px] text-center mt-10">Save Your Moments</h1>
    </section>
    <!--section gambar-->
    <section>
        <div class="flex flex-wrap justify-center gap-4 mt-10">
            <div>
                <div class="flex flex-col gap-4">
                    <div class="">
                        <img src="/assets/gambar_1.jpg" alt=""
                            class="w-[300px] rounded-lg transition duration-500 ease-in-out hover:scale-105">
                    </div>
                    <div class="">
                        <img src="/assets/gambar_2.jpg" alt=""
                            class="w-[300px] rounded-lg transition duration-500 ease-in-out hover:scale-105">
                    </div>
                </div>
            </div>
            <div class="">
                <img src="/assets/gambar_3.jpg" alt=""
                    class="w-[275px] rounded-lg transition duration-500 ease-in-out hover:scale-105">
            </div>
        </div>
    </section>
@endsection
