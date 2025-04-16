<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Support\Str;

#[ScopedBy([BusinessScope::class])]
class Invitation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            $invitation->token = Str::uuid();
        });
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }
}
