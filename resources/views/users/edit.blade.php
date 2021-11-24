<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-container>
            <div class="lg:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('profile.update') }}" method="post">
                            @method('put')
                            @csrf
                            <div class="mb-5">
                                <x-label for="username">Username</x-label>
                                <x-input id="username" value="{{ old('username', Auth::user()->username) }}" type="text" name="username" class="block mt-1 w-full"/>
                            </div>
                            <div class="mb-5">
                                <x-label for="email">Email</x-label>
                                <x-input id="email" value="{{ old('email', Auth::user()->email) }}" type="email" name="email" class="block mt-1 w-full"/>
                            </div>
                            <div class="mb-5">
                                <x-label for="name">Name</x-label>
                                <x-input id="name" value="{{ old('name', Auth::user()->name) }}" type="text" name="name" class="block mt-1 w-full"/>
                            </div>
                            <x-button>Update</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</x-app-layout>
