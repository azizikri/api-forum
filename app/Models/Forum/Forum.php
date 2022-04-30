<?php

namespace App\Models\Forum;

use App\Models\User;
use App\Models\Forum\ForumComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function comments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
