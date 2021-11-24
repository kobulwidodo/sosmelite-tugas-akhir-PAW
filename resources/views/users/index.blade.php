<x-app-layout>
    <div class="py-12">
        <x-container>
            <div class="grid grid-cols-3 gap-5">
                @foreach ($users as $user)
                    <x-card>
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <img class="rounded-full h-10 w-10" src="{{ $user->gravatar() }}" alt="">
                            </div>
                            <div>
                                <a class="font-semibold hover:text-blue-500 transition duration-200" href="{{ route('profile', $user->username) }}">
                                    {{ $user->name }}
                                </a>
                                <div class="text-gray-500 text-sm">
                                    {{ $user->followers_count }} Followers
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $users->links() }}
            </div>
        </x-container>
    </div>
</x-app-layout>
