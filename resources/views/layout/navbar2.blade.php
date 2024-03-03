<nav class="bg-white shadow-md w-full p-4 fixed top-0 z-20">
    <div class="flex flex-wrap justify-center max-w-screen-md mx-auto items-center">
        <a href="/home" class="mr-4">Home</a>
        <a href="/upload" class="mr-4">Upload</a>
        <form action="/home" method="GET">
        <input type="text" class="px-1 py-1 mr-3 w-[170px] rounded-full border border-gray-300" name="cari"
            placeholder="  Search ..." />
        </form>
        <div class="flex items-center space-x-1 md:order-2 md:space-x-0 rtl:space-x-reverse">
            <img src="/unggah/{{ old('pictures', Auth::User()->pictures) }}" alt="" class="w-10 h-10 border-2 rounded-full"
                data-dropdown-toggle="user-dropdown-menu" />
            <!--drop down-->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                id="user-dropdown-menu">
                <ul class="py-2" role="none">
                    <li>
                        <a href="/profile" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <div class="inline-flex items-center">Profile</div>
                        </a>
                    </li>
                    <li>
                        <a href="/logout" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <div class="inline-flex items-center">Logout</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
