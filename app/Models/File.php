<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'path',
    ];


    protected static function booted()
    {
        static::creating(function (File $file) {
            $file->unique_identifier = Str::random(12);
        });
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['search'] ?? '', function ($builder, $value) {
            $builder->where(function ($builder) use ($value) {
                $builder->where('name', 'LIKE', "%{$value}%")
                    ->orWhere('unique_identifier', 'LIKE', "%{$value}%");
            });
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
