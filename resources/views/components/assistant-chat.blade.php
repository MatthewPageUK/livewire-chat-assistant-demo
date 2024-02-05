{{-- Assistant Chat --}}

<x-header :mode="$this->mode">
    <span class="flex items-center gap-1">
        <x-assistant.talking-to />

        @if ($this->inChat)
            <x-assistant.buttons />
        @endif

    </span>
</x-header>

@if (! $this->inChat)
    <x-assistant.waiting />
@else

    {{-- <div class="h-[220px] overflow-auto px-4 mb-2"> --}}

    <div id="assistant-chat"
        x-data="{ height: 0, chatElement: document.getElementById('assistant-chat') }"
        x-init="
            height = chatElement.scrollHeight;
            $nextTick(() => {
                chatElement.scrollTop = chatElement.scrollHeight;
            });
        "
        x-on:assistant-chat-update.window="
            $nextTick(() => {
                chatElement.scrollTop = chatElement.scrollHeight;
            })
        "
        class="h-[210px] overflow-auto px-4 mr-4 mb-4"
    >

        @if ($this->messages)
            <ul>
                @foreach ($this->messages as $message)
                    <li
                        @class([
                            'mb-1 grid grid-cols-12 p-2 py-1 hover:bg-primary-700 gap-2',
                            'italic' => $message->user === 'Assistant',
                        ])
                    >
                        <span
                            @class([
                                'col-span-2 text-sm',
                                '' => $message->user === 'Assistant',
                                'bg-green-700 rounded p-1' => $message->user !== 'Assistant',
                            ])
                        >{{ $message->user }}</span>
                        <span class="col-span-7">{{ $message->message }}</span>
                        <span class="col-span-2 text-xs">{{ $message->created_at->format('d-m-Y @ H:i:s') }}</span>
                        <span class="col-span-1 text-right">
                            @if ($message->user !== 'Assistant')
                                <button class="p-1 bg-red-800 hover:bg-red-700 rounded-full" title="Report message">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                    </svg>
                                </button>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="flex items-end gap-1 px-4">
        <input type="text" wire:model="message" class="flex-1 border p-2 bg-primary-900 text-primary-100 rounded-bl-lg"></textarea>
        <button wire:click="sendMessage" class="p-2 bg-highlight-800 hover:bg-highlight-700 text-primary-100 flex w-32 justify-center rounded-br-lg" title="Send message">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
            </svg>
        </button>
    </div>
@endif
