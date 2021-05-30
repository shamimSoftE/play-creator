<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function userReciever()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'receiver_id');
    }
    public function adminSender()
    {
        return $this->belongsTo(Admin::class, 'sender_id');
    }
}
