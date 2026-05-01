<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'category',
        'condition', 'emoji', 'status', 'images', 'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array',
    ];

    public function isFree(): bool
    {
        return is_null($this->price) || $this->price == 0;
    }

    public function displayPrice(): string
    {
        return $this->isFree() ? 'PERCUMA' : 'RM' . number_format($this->price, 2);
    }
}
