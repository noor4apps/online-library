<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['checkout', 'status', 'date_returned', 'issue', 'user_id'];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;

        if ($value == 'checkout') {

            $this->attributes['checkout'] = date('Y-m-d H:i:s');

        } elseif ($value == 'returned') {

            $this->attributes['date_returned'] = date('Y-m-d H:i:s');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_order');
    }
}
