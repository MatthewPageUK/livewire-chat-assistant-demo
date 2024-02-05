<textarea
    type="text"
    wire:model="message"
    placeholder="Enter your message here..."
    class="placeholder:italic placeholder:text-xs border p-2 bg-primary-900 text-primary-100 w-full h-8 md:h-32 @error('message') border-red-500 @enderror"
></textarea>