<li
    @class([
        'mb-1 p-2 flex text-lg',
        'bg-primary-500 rounded-b-xl rounded-tl-xl ml-8' => $message->user === 'Assistant',
        'bg-primary-800 rounded-t-xl rounded-br-xl mr-8' => $message->user !== 'Assistant',
    ])
>
    <span class="flex-1 flex">
        @if ($message->user === 'Assistant')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
        @endif
        <span class="font-light text-sm pr-4 mr-4 border-r">{{ $message->user }}<br />
            <span class="text-xs">{{ $message->created_at->diffForHumans() }}</span>
        </span>
        <span class="flex-1 font-atma">{{ $message->message }}</span>
    </span>

    {{-- <span class="text-xs font-light">
        {{ $message->created_at->diffForHumans() }}
    </span> --}}
</li>