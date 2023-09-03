<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'user_agent', 'file_id', 'downloaded_at', 'country', 'ip_address'
    ];


    public function file()
    {
        return $this->belongsTo(File::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
