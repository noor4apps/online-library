<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'email', 'contact_number'];

    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
