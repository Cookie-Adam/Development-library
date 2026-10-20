<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function sessions(): HasMany
    {
        return $this->hasMany(ComputerSession::class);
    }
}
