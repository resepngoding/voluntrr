<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'leader_name', 'active'];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->Where('name', 'Like', '%' . $search . '%')
            ->orWhere('leader_name', 'Like', '%' . $search . '%');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
