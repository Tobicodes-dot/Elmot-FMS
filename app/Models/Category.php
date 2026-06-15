<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    protected $fillable = [
        'name'
    ];
}
