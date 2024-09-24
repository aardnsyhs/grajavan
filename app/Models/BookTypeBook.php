<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookTypeBook extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = ['book_id', 'book_type_id', 'stock', 'price', 'is_active'];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function bookType()
    {
        return $this->belongsTo(BookType::class, 'book_type_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
