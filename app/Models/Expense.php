<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\Expenses\BaseExpenseService;
use App\Services\Expenses\ComercialExpenseService;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'description',
        'category',
        'value',
        'project_id',
        'supplier_id',
        'tax'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(related: Project::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(related: Supplier::class);
    }
}
