<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'book_id', 'staff_id', 'borrowed_at', 'due_at', 'returned_at'];

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'date',
            'due_at' => 'date',
            'returned_at' => 'date',
        ];
    }

    // Not yet returned
    public function scopeActive(Builder $query): void
    {
        $query->whereNull('returned_at');
    }

    // Not returned and past its due date
    public function scopeOverdue(Builder $query): void
    {
        $query->whereNull('returned_at')->whereDate('due_at', '<', today());
    }

    public function isOverdue(): bool
    {
        return $this->returned_at === null && $this->due_at->lt(today());
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
