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
       return $this->belongsTo(Question::class);
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($answer){
           $answer->question->increment('answers_count');
        });

    }
}


