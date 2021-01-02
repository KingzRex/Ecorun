<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Manager extends Model
{
    use HasFactory, QueryCacheable;
    
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function revoke()
    {
        $this->businesses()->revoke();

        $this->delete();
    }
}
