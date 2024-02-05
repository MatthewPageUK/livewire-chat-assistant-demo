<?php

namespace App\Livewire;

use App\Models\ChatLog;
use App\Enums\ChatAssistantMode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatAssistant extends Component
{
    public ChatAssistantMode $mode = ChatAssistantMode::Customer;

    public string $name = '';

    public ?Carbon $lastPoll = null;

    public int $lastMessageCount = 0;

    protected ?Collection $messages = null;

    #[Validate('required', onUpdate: false)]
    public string $message = '';

    public bool $inChat = false;

    public function mount()
    {
        $this->setPollTime()
            ->flushChatMessages();
    }

    #[Computed]
    public function messages()
    {
        return $this->messages;
    }

    public function startChat()
    {
        $this->setChatName()
            ->setInChat()
            ->postEnteredChatNotice()
            ->setChatMessages();
    }

    public function checkForMessages()
    {
        $this->setInChat()
            ->setPollTime()
            ->setChatMessages()
            ->when($this->isAssistant() && $this->hasNewMessages(), function() {
                $this->dispatch('assistant-chat-update');
            })
            ->when($this->hasNewMessages(), function() {
                $this->setMessageCount()
                    ->dispatch('customer-chat-update');
            })
            ->when(! $this->hasMessages(), function() {
                $this->endChat();
            });
    }

    public function endChat()
    {
        $this->setInChat(false)
            ->setChatName('')
            ->flushChatMessages();
    }

    public function sendMessage()
    {
        $this->postChatMessage()
            ->resetMessage()
            ->setChatMessages();

        if ($this->isCustomer()) {
            $this->dispatch('customer-chat-update');
        }
    }

    public function isCustomer(): bool
    {
        return $this->mode === ChatAssistantMode::Customer;
    }

    public function isAssistant(): bool
    {
        return $this->mode === ChatAssistantMode::Assistant;
    }

    // -----------------

    protected function when(bool $condition, \Closure $callback): self
    {
        return $condition ? ( $callback() ?: $this ) : $this;
    }

    protected function resetMessage(): self
    {
        $this->message = '';
        return $this;
    }

    protected function postChatMessage(): self
    {
        ChatLog::create([
            'session' => session()->getId(),
            'user' => $this->isCustomer() ? $this->name : 'Assistant',
            'message' => $this->message,
        ]);
        return $this;
    }

    protected function postEnteredChatNotice(): self
    {
        ChatLog::create([
            'session' => session()->getId(),
            'user' => $this->name,
            'message' => '...entered the chat',
        ]);
        return $this;
    }

    protected function setInChat(bool $in = true): self
    {
        $this->inChat = $in;
        return $this;
    }

    protected function setChatName(?string $name = null): self
    {
        if ($name) {
            $this->name = $name;
        } else {
            $this->name = $this->name ?: 'Anomy Mouse';
        }
        return $this;
    }

    protected function hasMessages(): bool
    {
        return $this->messages->count() > 0;
    }

    protected function setMessageCount(): self
    {
        $this->lastMessageCount = $this->messages->count();
        return $this;
    }

    protected function hasNewMessages(): bool
    {
        return $this->lastMessageCount < $this->messages->count();
    }

    protected function flushChatMessages(): self
    {
        ChatLog::session(session()->getId())->delete();
        return $this;
    }

    protected function setPollTime(): self
    {
        $this->lastPoll = now();
        return $this;
    }

    protected function setChatMessages(): self
    {
        $this->messages = ChatLog::session(session()->getId())->get();
        return $this;
    }

    public function render()
    {
        return view('chat-assistant');
    }
}
