<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender() :BelongsTo {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver() :BelongsTo {
        return $this->belongsTo(User::class,'receiver_id');
    }
    
    public function messageTime()
    {
        $timezone = 'Asia/Dhaka';
        $time = Carbon::parse($this->created_at)->timezone($timezone);
    
        if ($time->isToday()) {
            return $time->format('h:i A') . ', Today';
        } elseif ($time->isYesterday()) {
            return $time->format('h:i A') . ', Yesterday';
        } else {
            return $time->format('h:i A, M d, Y');
        }
    }
    


}