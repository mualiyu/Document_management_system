<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sharing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'start_time',
        'stop_time',
        'status',
        'uuid',
        'description',
        'terms',
        'n_d_a',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, "document_sharings", "sharing_id", 'document_id');
    }
}
