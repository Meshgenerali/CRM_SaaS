<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([BusinessScope::class])]

class Lead extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
