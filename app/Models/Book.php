<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isbn', 'quantity', 'edition', 'volume', 'issue', 'cover', 'is_pdf', 'url', 'publisher_id'];

    protected $casts = [
        'is_pdf' => Boolean::class
    ];

    protected $appends = ['is_pdf_str', 'img_full_path'];

    public function setIsPdfAttribute($value)
    {
            $this->attributes['is_pdf'] = true;
    }

    public function getIsPdfAttribute($value)
    {
        return $value == true ?? false;
    }

    public function getImgFullPathAttribute($value)
    {
        return asset('storage/' . $this->cover);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_users');
    }
}
