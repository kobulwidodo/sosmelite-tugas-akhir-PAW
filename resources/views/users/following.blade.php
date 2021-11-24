<x-app-layout>
    <div class="py-12 bg-white border-b">
        <x-container>
            <div class="flex">
                <div class="flex-shrink-0 mr-3">
                    <img class="rounded-full w-20 h-20 border-2 p-1 border-blue-400" src="{{ $user->gravatar() }}" alt="">
                </div>
                <div class="my-auto">
                    <h1 class="font-semibold mb-2">{{ $user->name }}</h1>
                    <div class="text-sm text-gray-500">Bergabung {{ $user->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </x-container>
    </div>
    <div class="border-b bg-white mb-5">
        <x-container>
            <x-stat-navbar :user="$user"></x-stat-navbar>
        </x-container>
    </div>
    <x-container>
        <x-stat-profile :stats="$stats" />
    </x-container>
</x-app-layout>
