<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content_id','name','comment'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}