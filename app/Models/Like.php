<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Like extends Model
{
    use HasFactory;

    protected $fillable=[
        'feed_id',
        'user_id'
    ];

    public function feed(): BelongsTo{
        return $this->belongsTo(Feed::class);
    }


}
