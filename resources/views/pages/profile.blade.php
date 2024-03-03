@extends('layout.profile')
@push('cssjsexternal')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('content2')
    <section class="mt-32">
        @csrf
        <div class="flex flex-col max-w-screen-md px-2 mt-4 mx-auto items-center">
            <div>
                <img src="/unggah/{{ old('pictures', Auth::User()->pictures) }}" alt="" class="w-28 rounded-full" />
            </div>
            <h3 class="text-xl font-semibold mt-2">{{ old('username', Auth::User()->username) }}</h3>
            <small class="text-xs">{{ old('bio', Auth::User()->bio) }}</small>
            <div class="flex flex-row mt-3">
                <small class="mr-4 text-gray-400" id="followers"> {{ $userFollowers }} Followers </small>
                <small class="text-gray-400" id="following">{{ $dataFollowCount }} Following</small>
            </div>
            <div class="flex flex-row mt-5">
                <a href="/edit_profile">
                    <button class="px-4 py-1 text-white rounded-full bg-blue-900">
                        Edit Profile
                    </button>
                </a>
                <div class="p-1"></div>
                <a href="/ubahpassword">
                    <button class="px-4 py-1 text-white rounded-full bg-blue-900">
                        Edit Password
                    </button>
                </a>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-screen-xl">
        <div class="mb-4 mt-10 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                        Unggahan
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">
                        Album
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">
                        Liked
                    </button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <!--unggahan-->
            <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <section class="">
                    <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
                        @csrf
                        <div class="flex flex-wrap items-center flex-container justify-center gap-3" id="postingandata">
                            {{-- <div class="flex mt-2 bg-white">
                                <div class="flex flex-col px-2">
                                    <a href="explore-detail.html">
                                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                                            <a href="explore_detail.html">
                                                <img src="/assets/gambar_2.jpg" alt=""
                                                    class="w-full transition duration-500 ease-in-out hover:scale-105 rounded-md" />
                                            </a>
                                        </div>
                                    </a>
                                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                                        <div>
                                            <div class="flex flex-col">
                                                <div>Kebahagiaan</div>
                                                <div class="text-xs text-abuabu">15w</div>
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
            </div>
            <!--album-->
            <div class="hidden p-4 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <section class="">
                    <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
                        <div class="flex flex-wrap items-center flex-container justify-center gap-3">
                            @foreach ($tampilAlbum as $album)
                                <a href="{{ route('detail_album.show', $album->id) }}">
                                    <img src="/assets/logo_folder1.png" alt=""
                                        class="w-full transition duration-500 ease-in-out hover:scale-105 rounded-md" />
                                    <div class="font-poppins font-semibold text-center">
                                        {{ $album->nama_album }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                </section>
            </div>
            <!--liked-->
            <div class="hidden p-4 rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <section class="">
                    <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
                        @csrf
                        <div class="flex flex-wrap items-center flex-container justify-center gap-3" id="liked">
                            <!--data foto ang di like-->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    {{-- <script src="/node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endsection
@push('footerjsexternal')
    <script src="/javascript/postingan.js"></script>
    <script src="/javascript/liked.js"></script>
@endpush
