<x-app-layout>
    <div class="py-12">
        <x-container>
            <div class="lg:w-2/3">
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
                        <div class="grid place-content-between justify-items-end">
                            @if($status->user->id == Auth::user()->id)
                                <div class="flex sm:items-center sm:ml-6">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-button class="modal-open">
                                                {{ __('Edit Status') }}
                                            </x-dropdown-button>
                                            <form action="{{ route('status.destroy', $status->identifier) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-button type="submit" name="delete">
                                                    {{ __('Delete Status') }}
                                                </x-dropdown-button>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                @else
                                <div class=""></div>
                                @endif
                        </div>
                    </div>
                </x-card>
                <!--Modal-->
                <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                    
                    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                        <!-- Add margin if you want to see some of the overlay behind the modal-->
                        <div class="modal-content py-4 text-left px-6">
                            <!--Title-->
                            <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Edit Status</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                            </div>
                            </div>
                            <form action="{{ route('status.update', $status->identifier) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="my-2">
                                    <textarea placeholder="Apa yang ada dipikiranmu?" rows="6" name="body" class="form-textarea w-full rounded-lg border-gray-300 focus:border-blue-200 focus:ring focus:ring-blue-300 transition duration-200">{{ $status->body }}</textarea>
                                </div>
                                <div class="text-right">
                                    <x-button>
                                        {{ __('Update') }}
                                    </x-button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <div class="font-semibold text-grey-600 mb-5 mt-5">Komentar</div>
                <div class="mb-4">
                    <x-card>
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <img class="rounded-full h-10 w-10" src="{{ Auth::user()->gravatar() }}" alt="">
                            </div>
                            <div class="w-full">
                                <div class="font-semibold">
                                    {{ Auth::user()->name }}
                                </div>
                                <form action="{{ route('reply.store', $status->identifier) }}" method="post">
                                    @csrf
                                    <div class="my-2">
                                        <textarea placeholder="Tulis Komentarmu" name="body" class="form-textarea w-full rounded-lg resize-none border-gray-300 focus:border-blue-200 focus:ring focus:ring-blue-300 transition duration-200"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <x-button>
                                            {{ __('Komentar') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </x-card>
                </div>
                <x-card>
                    <div class="space-y-6">
                        @forelse ($replies as $reply)
                            <div class="flex justify-between">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <img class="rounded-full h-10 w-10" src="{{ $reply->user->gravatar() }}" alt="">
                                    </div>
                                    <div>
                                        <a class="font-semibold hover:text-blue-500 transition duration-200" href="{{ route('profile', $reply->user->username) }}">
                                            {{ $reply->user->name }}
                                        </a>
                                        <div class="leading-relaxed">
                                            {!! nl2br(e($reply->comment)) !!}
                                        </div>
                                        <div class="text-gray-500 text-sm">
                                            {{ $reply->created_at->DiffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="grid place-content-between justify-items-end">
                                    @if($reply->user->id == Auth::user()->id)
                                        <div class="flex sm:items-center sm:ml-6">
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </x-slot>

                                                <x-slot name="content">
                                                    <form action="{{ route('reply.destroy', $status->identifier) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <x-dropdown-button type="submit" name="delete">
                                                            {{ __('Delete Reply') }}
                                                        </x-dropdown-button>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                        @else
                                        <div class=""></div>
                                        @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center">Belum Ada Komentar</div>
                        @endforelse
                    </div>
                </x-card>
            </div>
        </x-container>
    </div>
    <x-slot name="script">
        <script>
            var openmodal = document.querySelectorAll('.modal-open')
            for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
            }
            
            const overlay = document.querySelector('.modal-overlay')
            overlay.addEventListener('click', toggleModal)
            
            var closemodal = document.querySelectorAll('.modal-close')
            for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
            }
            
            document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
            };
            
            
            function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
            }
        </script>
    </x-slot>
</x-app-layout>
