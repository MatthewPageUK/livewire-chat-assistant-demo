<div
    wire:poll.3s="checkForMessages"
    class="relative border-b bg-primary-900 rounded-xl"
>
    <x-dynamic-component :component="$this->mode->getBladeComponent()" />
</div>
