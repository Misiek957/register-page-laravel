<nav class="md:flex md:justify-between md:items-center">
    <div>
        <a href="/">
            <img src="./images/logo.svg" alt="Logo" width="165" height="16">
        </a>
    </div>

    <div class="mt-12 md:mt-0">
        {{-- <a href="/" style="margin-right:10px" class="text-xs font-bold uppercase">Home Page</a> --}}

        @guest
            <a href="/login" style="margin-right:10px" class="text-xs font-bold uppercase">Log in</a>
            <a href="/register" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Register
            </a>
        @endguest
        @auth
            <h1 class="text-xs font-bold uppercase" style="display:inline-block ">
                Logged in as {{auth()->user()->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </h1>
            <form method="POST" action="/logout" style="display:inline-block">
                @csrf
                <button type="submit" class="text-xs font-bold uppercase"> Logout </button>
            </form>
            <a href="/account" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                My Account
            </a>
        @endauth
    </div>
</nav>