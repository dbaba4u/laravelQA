<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Sodium\crypto_box_publickey_from_secretkey;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [''];

    public function question()
    {
        $this->belongsTo(Question::class);
    }
    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
}


