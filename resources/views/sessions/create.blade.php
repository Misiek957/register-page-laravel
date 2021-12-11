<x-layout>
    <section class="px-6 py-8" style="text-align:center">
        
        
        <main class="max-w-lg mx-auto mt-20 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register Form</h1>
            {{-- Name field --}}
            <form method="POST" action="/login">
                @csrf
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
                        value="{{ old('username')}}"
                        required
                    >
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- password field --}}
                {{-- Pass along attributes (email,name password) in POST--}}
                <div class="mb-6 mt-5">
                    <label 
                        for="password" 
                        class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    >
                        Password
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
                {{-- submit buttom --}}
                <div class="mb-6">
                    <button type="submit"
                        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Log in
                    </button>
                </div>
                @if ($errors->all()) {{--if not empty check--}}
                    @foreach ($errors->all() as $error) {{--usually present as empty container--}}
                        <li class="text-xs text-red">{{ $error }}</li> {{-- list --}}
                    @endforeach
                @endif

            </form>
            

        </main>
    </section>
</x-layout>