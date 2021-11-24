<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Password') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-container>
            <div class="lg:w-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('password.edit') }}" method="post">
                            @method("put")
                        @csrf
                        <div class="mb-5">
                            <x-label for="current_password">Current Password</x-label>
                            <x-input class="mt-1 w-full" type="password" name="current_password" id="current_password"/>
                        </div>
                        <div class="mb-5">
                            <x-label for="password">New Password</x-label>
                            <x-input class="mt-1 w-full" type="password" name="password" id="password"/>
                        </div>
                        <div class="mb-5">
                            <x-label for="password_confirmation">Confirm Password</x-label>
                            <x-input class="mt-1 w-full" type="password" name="password_confirmation" id="password_confirmation"/>
                        </div>
                        <x-button>Update</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</x-app-layout>
