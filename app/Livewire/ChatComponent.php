<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;

class ChatComponent extends Component
{
    public $selectedUser = null;
    public $sender_id;
    // #[Url('username')]
    public $receiver_id;
    public $messages = [];

    public function mount($username = null) {
        if($username) {
            $user = User::where('username',$username)->where('id', '!=', Auth::id())->first();
            $this->sender_id = Auth::id();
            if(!$user) {
             abort(404);
            }
            $this->receiver_id = $user->id;
            $this->selectedUser = $user;
        }

        $this->loadMessages();
        $this->changeTheActiveStatus();

    }

    public function changeTheActiveStatus() {
        $user = Auth::user();
        $user->update(['last_active_at' => Carbon::now('Asia/Dhaka')]);
    }

    public function changeSelectedUser(User $user) {
        $this->selectedUser = $user;
    }

    public function loadMessages() {
        $messages = Message::where(function($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })->get();
        
        $this->messages = $messages;
    }

    public function render()
    {
        $users = User::where('id', '!=' ,Auth::id())->get();
        return view('livewire.chat-component',compact('users'));
    }
}