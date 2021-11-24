<h3 class="font-semibold text-gray-500 mb-3">{{ $type }}</h3>
<div class="grid grid-cols-3 gap-5">
    @foreach ($stats as $stat)
    <x-card>
        <div class="flex">
            <div class="flex-shrink-0 mr-3">
                <img class="rounded-full h-10 w-10" src="{{ $stat->gravatar() }}" alt="">
            </div>
            <div>
                <a class="font-semibold hover:text-blue-500 transition duration-200" href="{{ route('profile', $stat->username) }}">
                    {{ $stat->name }}
                </a>
                <div class="text-gray-500 text-sm">
                    {{ $stat->created_at->DiffForHumans() }}
                </div>
            </div>
        </div>
    </x-card>
    @endforeach
</div>
