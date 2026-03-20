<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'active',
        'position',
    ];

    protected $casts = [
        'active' => 'boolean',
        'position' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Make position unique by adjusting other positions when a new one is created
        static::creating(function ($advertisement) {
            $advertisement->ensureUniquePosition();
        });

        static::updating(function ($advertisement) {
            $advertisement->ensureUniquePosition();
        });
    }

    /**
     * Ensure the position is unique by shifting other positions if needed
     */
    public function ensureUniquePosition()
    {
        if ($this->position !== null) {
            // Check if there's already an advertisement with this position
            $existingWithSamePosition = self::where('position', $this->position)
                ->where('id', '!=', $this->id ?? 0)
                ->first();

            if ($existingWithSamePosition) {
                // Shift existing advertisements with same or higher position
                self::where('position', '>=', $this->position)
                    ->where('id', '!=', $this->id ?? 0)
                    ->increment('position');
            }
        }
    }
}
