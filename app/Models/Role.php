<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([BusinessScope::class])]
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_id'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
