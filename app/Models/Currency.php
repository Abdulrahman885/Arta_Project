<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    
    protected $fillable = ['code', 'name'];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
