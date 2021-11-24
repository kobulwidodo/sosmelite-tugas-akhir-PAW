<x-card>
    <div class="flex justify-between">
        <div class="flex">
            <div class="flex-shrink-0 mr-3">
                <img class="rounded-full h-10 w-10" src="{{ $status->user->gravatar() }}" alt="">
            </div>
            <div>
                <a class="font-semibold hover:text-blue-500 transition duration-200" href="{{ route('profile', $status->user->username) }}">
                    {{ $status->user->name }}
                </a>
                <div class="leading-relaxed">
                    {!! nl2br(e($status->body)) !!}
                </div>
                <div class="text-gray-500 text-sm">
                    {{ $status->created_at->DiffForHumans() }}
                </div>
            </div>
        </div>
        <div class="grid place-content-end justify-items-end">
            <a href="{{ route('status.show', $status->identifier) }}">
                    <div class="text-gray-500 text-sm mr-1">Lihat >></div>
            </a>
        </div>
    </div>
</x-card>
