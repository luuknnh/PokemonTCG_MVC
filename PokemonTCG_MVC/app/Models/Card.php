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


    /**
     * Get the user that owns the card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     * Returns the relationship between the card and its owner.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the collections that belong to the card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 
     * Returns the relationship between the card and its collections.
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_card', 'card_id', 'collection_id');
    }
}