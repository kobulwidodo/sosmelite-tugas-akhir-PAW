<x-app-layout>
    <div class="py-12 bg-white border-b">
        <x-container>
            <div class="flex justify-between items-center">
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <img class="rounded-full w-20 h-20 border-2 p-1 border-blue-400" src="{{ $user->gravatar() }}" alt="">
                    </div>
                    <div class="my-auto">
                        <h1 class="font-semibold mb-2">{{ $user->name }}</h1>
                        <div class="text-sm text-gray-500">Bergabung {{ $user->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div>
                    @if (Auth::user()->isNot($user))
                        <form action="{{ route('follow.store', $user) }}" method="post">
                            @csrf
                            @if (Auth::user()->hasFollow($user))
                                <x-button-white>Unfollow</x-button-white>
                            @else
                                <x-button>Follow</x-button>
                            @endif
                        </form>
                    @else
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-400 disabled:opacity-25 transition ease-in-out duration-150">Edit Profile</a>
                    @endif
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
        <h3 class="font-semibold text-gray-500 mb-3">Status</h3>
        <div class="grid grid-cols-1">
            <div class="space-y-6">
                @foreach ($user->statuses()->with('user')->latest()->get() as $status)
                <x-status :status="$status" />
                @endforeach
            </div>
        </div>
    </x-container>
</x-app-layout>
