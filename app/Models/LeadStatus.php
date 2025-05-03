<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([BusinessScope::class])]

class LeadStatus extends Model
{
    protected $fillable = ['name', 'slug', 'color', 'order', 'is_active', 'business_id'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'status', 'name');
    }

    public function businesses() {
        return $this->belongsTo(Businesses::class);
    }
}
