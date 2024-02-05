{{-- Customer Chat --}}

<x-header :mode="$this->mode">
    @if ($this->inChat)
        In chat
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
        </svg>
    @endif
</x-header>

@if (! $this->inChat)
    <x-customer.start />
@else

    <div class="grid grid-cols-4 gap-4 px-4">

        <div id="customer-chat"
            x-data="{ height: 0, chatElement: document.getElementById('customer-chat') }"
            x-init="
                height = chatElement.scrollHeight;
                $nextTick(() => {
                    chatElement.scrollTop = chatElement.scrollHeight;
                });
            "
            x-on:customer-chat-update.window="
                $nextTick(() => {
                    chatElement.scrollTop = chatElement.scrollHeight;
                })
            "
            class="col-span-4 md:col-span-3 h-[220px] pr-4 overflow-auto"
        >
            @if ($this->messages)
                <ul>
                    @foreach ($this->messages as $message)
                        <x-customer.chat-message :message="$message" />
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="col-span-4 md:col-span-1 md:grid md:grid-cols-1 auto-rows-min gap-2">

            <x-customer.chat-box />

            <div class="flex md:block">
                <button
                    wire:click="sendMessage"
                    class="
                        hover:shadow-[0_0_60px_0px]
                        border border-green-800
                        py-2 px-4
                        bg-green-800 hover:bg-green-700
                        hover:shadow-green-500/50
                        hover:shadow-xl
                        hover:text-white
                        w-8 md:w-full flex justify-center"
                    title="Send message"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                </button>
                <button
                    wire:click="endChat"
                    class="
                        hover:shadow-[0_0_60px_0px]
                        border border-red-800
                        py-2 px-4
                        bg-red-800 hover:bg-red-700
                        hover:shadow-red-500/50
                        hover:shadow-xl
                        hover:text-white
                        w-8 md:w-full flex justify-center"
                    title="End chat"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>

@endif
