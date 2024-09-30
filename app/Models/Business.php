<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'expire_at',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'industry'
    ];

    protected function casts(): array
        {
            return [
                'expire_at' => 'datetime:Y-m-d',
            ];
        }

        public function users()
        {
            return $this->belongsToMany(User::class);
        }

        public function plan() {
            return $this->belongsTo(Plan::class);
        }
}
