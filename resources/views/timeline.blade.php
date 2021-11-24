<x-app-layout>
    <div class="py-12">
        <x-container>
            <div class="grid grid-cols-12 gap-6 items-stretch">
                <div class="col-span-12 md:col-span-7">
                    <x-card :className="__('mb-5')">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <img class="rounded-full h-10 w-10" src="{{ Auth::user()->gravatar() }}" alt="">
                            </div>
                            <div class="w-full">
                                <div class="font-semibold">
                                    {{ Auth::user()->name }}
                                </div>
                                <form action="{{ route('status.store') }}" method="post">
                                    @csrf
                                    <div class="my-2">
                                        <textarea placeholder="Apa yang ada dipikiranmu?" name="body" class="form-textarea w-full rounded-lg resize-none border-gray-300 focus:border-blue-200 focus:ring focus:ring-blue-300 transition duration-200"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <x-button>
                                            {{ __('Post') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </x-card>
                    <div class="space-y-6">
                        @foreach ($statuses as $status)
                        <x-status :status="$status" />
                        @endforeach
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5 overflow-hidden ">
                    <x-card>
                        <div class="font-semibold mb-5">Baru saja di Follow</div>
                        <div class="space-y-6">
                            @foreach ($followings as $following)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="rounded-full h-10 w-10" src="{{ $following->gravatar() }}" alt="">
                                </div>
                                <div>
                                    <a class="font-semibold hover:text-blue-500 transition duration-200" href="{{ route('profile', $status->user->username) }}">
                                        {{ $following->name }}
                                    </a>
                                    <div class="text-gray-500 text-sm">
                                        {{ $following->pivot->created_at->DiffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </x-card>
                </div>
            </div>
        </x-container>
    </div>
</x-app-layout>
