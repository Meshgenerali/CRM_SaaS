<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function businesses() {
        return $this->belongsToMany(Business::class, 'business_plan')
                    ->withPivot('starts_at', 'ends_at', 'trial_ends_at', 'is_trial', 'is_active')
                    ->withTimestamps();
    }
}
