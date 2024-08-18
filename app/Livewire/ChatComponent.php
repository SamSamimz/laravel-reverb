<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $selectedUser = null;

    public function mount($username = null) {
        if($username) {
            $user = User::where('username',$username)->where('id', '!=', Auth::id())->first();
            if(!$user) {
             abort(404);
            }
        }
    }

    public function render()
    {
        $users = User::where('id', '!=' ,Auth::id())->get();
        return view('livewire.chat-component',compact('users'));
    }
}