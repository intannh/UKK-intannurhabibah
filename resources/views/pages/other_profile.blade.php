@extends('layout.other_profile')
@push('cssjsexternal')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('content2')
    <section class="mt-32">
        @csrf
        <div class="flex flex-col max-w-screen-md px-2 mt-4 mx-auto items-center">
            <div>
                <img src="" alt="" class="w-28 rounded-full" id="pictures" />
            </div>
            <h3 class="text-xl font-semibold mt-2" id="username"></h3>
            <small class="text-xs" id="bio"></small>
            <div class="flex flex-row mt-2">
                {{-- <a href="" id="pengikut"> --}}
                    <small class="mr-4 text-gray-400" id="followers"></small>
                {{-- </a> --}}
                {{-- <a href="" id="mengikuti"> --}}
                    <small class="text-gray-400" id="following"></small>
                {{-- </a> --}}
            </div>
            @if ($user_id != auth()->user()->id)
                <div id="tombolfollow">
                    @if (in_array(auth()->user()->id, $folowers_id))
                    <!--unfollow-->
                        <button class="px-4 mt-4 bg-gray-200 rounded-full"
                            onclick="ikuti(this,'1')"></button>
                    @else
                    <!--follow-->
                        <button class="px-4 mt-4 bg-gray-200 rounded-full"
                            onclick="ikuti(this,'1')"></button>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <div class="mx-auto max-w-screen-xl">
        <div class="mb-4 mt-5 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                        Unggahan
                    </button>
                </li>
                {{-- <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">
                        Album
                    </button>
                </li> --}}
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
                    @csrf
                    <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
                        <input type="hidden" value="{{ $user_id }}" id="input-user_id">
                        <div class="flex flex-wrap items-center flex-container justify-center gap-3" id="publicfoto">
                            <!--isi-->
                        </div>
                    </div>
                </section>
            </div>
            <!--liked-->
            <div class="hidden p-4 rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <section class="">
                    @csrf
                    <div class="flex flex-wrap max-w-screen-xl mx-auto justify-center">
                        <input type="hidden" value="{{ $user_id }}" id="input-user_id">
                        <div class="flex flex-wrap items-center flex-container justify-center gap-3" id="likedpublic">
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
    <script src="/javascript/otherprofile.js"></script>
    <script src="/javascript/likedpublic.js"></script>
@endpush
