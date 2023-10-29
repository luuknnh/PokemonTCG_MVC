<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'userid', 'quantity', 'active'];

    protected $attributes = [
        'quantity' => 0, 
    ];

    /**
     * Get the card that owns the collection.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     * Returns the relationship between the collection and its card.
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the user that owns the collection.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     * Returns the relationship between the collection and its user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    /**
     * Get the quantity of cards in the collection.
     *
     * @return int 
     * Returns the count of cards in the collection.
     */
    public function getQuantityAttribute()
    {
        return $this->cards()->count();
    }

    /**
     * Get the cards that belong to the collection.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 
     * Returns the relationship between the collection and its cards.
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'collection_card', 'collection_id', 'card_id');
    }



}