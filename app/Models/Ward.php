<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\SickBay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function casts():array{
        return [
            'is_available'=>'boolean',
        ];
    }

  
    public function sickbay(): HasMany{
        return $this->hasMany(SickBay::class);
    }
}
