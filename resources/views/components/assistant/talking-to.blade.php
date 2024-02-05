<span class="hidden md:inline text-base">Talking to</span>
<select class="text-base bg-primary-800 px-2 py-2 mr-2">
    <option>Offline</option>
    <option>Waiting</option>
    <option selected>{{ collect($this->messages)->first()?->user }}</option>
    <option>Cyberbob</option>
    <option>AcidBurn</option>
</select>