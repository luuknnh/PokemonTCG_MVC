<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'userid', 'quantity'];

    protected $attributes = [
        'quantity' => 0, 
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQuantityAttribute()
    {
        return $this->cards()->count();
    }
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'collection_card', 'collection_id', 'card_id');
    }


}
