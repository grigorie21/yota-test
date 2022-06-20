<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $fillable = [
        'text',
        'parent_id',
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(Comment::class, 'id', 'parent_id');
    }

    public function nested(): HasMany {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
