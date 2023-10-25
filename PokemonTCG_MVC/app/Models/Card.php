<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

        protected $fillable = [
        'name', 'type', 'rarity', 'image',

    ];

protected $attributes = [
    'image' => '',
];


    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_card', 'card_id', 'collection_id');
    }
}
