<x-layout>
    <section class="px-6 py-8" style="text-align:center">
        
        
        <main class="max-w-lg mx-auto mt-20 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">User details</h1>
            <div>
                {{-- Name field --}}
                <form method="POST" action="/update">
                    @method('PUT')
                    @csrf
                    {{-- name field --}}
                    {{-- Pass along attributes (email,name password) in POST--}}
                    <div class="mb-6 mt-5">
                        <label 
                            for="name" 
                            class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                            Name
                        </label>

                        <input
                            class="border border-gray-400 p-2 w-full"
                            name="name"
                            type="text"
                            id="name"
                            value="{{auth()->user()->name}}"
                            required
                        >

                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Username field --}}
                    {{-- Pass along attributes (email,name password) in POST--}}
                    <div class="mb-6 mt-5">
                        <label 
                            for="username" 
                            class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                            Username
                        </label>

                        <input
                            class="border border-gray-400 p-2 w-full"
                            name="username"
                            type="text"
                            id="username"
                            value="{{auth()->user()->username}}"
                            required
                        >
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- email field --}}
                    {{-- Pass along attributes (email,name password) in POST--}}
                    <div class="mb-6 mt-5">
                        <label 
                            for="email" 
                            class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                            Email
                        </label>

                        <input
                            class="border border-gray-400 p-2 w-full"
                            name="email"
                            type="email"
                            id="email"
                            value="{{auth()->user()->email}}"
                            required
                        >
                    
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    {{-- New password field --}}
                    {{-- Pass along attributes (email,name password) in POST--}}
                    <div class="mb-6 mt-5">
                        <label 
                            for="password" 
                            class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                            New Password
                        </label>

                        <input
                            class="border border-gray-400 p-2 w-full"
                            name="password"
                            type="password"
                            id="password"
                            value="{{ old('password')}}"
                            required
                        >
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- repeat new password field --}}
                    {{-- Pass along attributes (email,name password) in POST--}}
                    <div class="mb-6 mt-5">
                        <label 
                            for="repeat_password" 
                            class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                            Repeat New Password
                        </label>

                        <input
                            class="border border-gray-400 p-2 w-full"
                            name="repeat_password"
                            type="password"
                            id="repeat_password"
                            required
                        >
                    </div>

                    {{-- submit buttom --}}
                    <div class="mb-6">
                        <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                        >
                            Update details
                        </button>
                    </div>
                    @if ($errors->all()) {{--if not empty check--}}
                        @foreach ($errors->all() as $error) {{--usually present as empty container--}}
                            <li class="text-xs text-red">{{ $error }}</li> {{-- list --}}
                        @endforeach
                    @endif
                    
                </form>
            </div>
            <div>
                <form method="POST" action="/delete">
                    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                    @method('DELETE')
                    @csrf
                    <div class="mb-6">
                        <button type="submit"
                        class="bg-red-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                        >
                            Delete account
                        </button>
                    </div>
                    {{-- TODO: Display warning --}}
                </form>
            </div>

        </main>


    </section>
</x-layout>