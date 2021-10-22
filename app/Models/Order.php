<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'book_users';

    protected $fillable = ['checkout', 'status', 'date_returned', 'issue', 'user_id', 'book_id'];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;

        if ($value == 'checkout') {

            $this->attributes['checkout'] = date('Y-m-d H:i:s');

        } elseif ($value == 'returned') {

            $this->attributes['date_returned'] = date('Y-m-d H:i:s');
        }
    }
}
