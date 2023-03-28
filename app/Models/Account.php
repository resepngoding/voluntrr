<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'account_number',
        'description',
        'is_active'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->Where('name', 'Like', '%' . $search . '%')
            ->orWhere('description', 'Like', '%' . $search . '%');
    }
}
