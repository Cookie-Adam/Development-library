<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory;

    // Laravel would guess "staffs" otherwise
    protected $table = 'staff';

    protected $fillable = ['name', 'email', 'phone', 'role'];

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function computerSessions(): HasMany
    {
        return $this->hasMany(ComputerSession::class);
    }
}
