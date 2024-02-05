<div class="p-4 text-center">
    <div class="max-w-sm mx-auto">
        <p class="mb-4">Welcome to our live assistant, please enter your name and start a chat with our live (non AI) assistants.</p>
        <form wire:submit.prevent="startChat">
            <input type="text" placeholder="Please enter your name..." wire:model="name" class="border p-2 bg-primary-900 text-primary-100 placeholder:italic placeholder:text-sm">
            <button type="submit" class="
                hover:shadow-[0_0_60px_0px]
                border border-green-800
                py-2 px-4
                bg-green-800
                hover:bg-green-700
                hover:shadow-green-500/50
                hover:shadow-xl
                hover:text-white"
            >
                Start Chat
            </button>
        </form>
    </div>
</div>