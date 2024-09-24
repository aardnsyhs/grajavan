<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookType extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ["name", "image", "is_active"];

    public $incrementing = false;

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function bookTypeBooks()
    {
        return $this->hasMany(BookTypeBook::class, 'book_type_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'book_type_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'book_id');
    }
}
