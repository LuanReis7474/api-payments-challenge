<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'session_id',
        'total_budget',
        'type',
        'description'
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(related: Expense::class);
    }
}
