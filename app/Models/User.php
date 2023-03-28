<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'team_id',
        'image',
        'address',
        'city',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function userRoleList()
    {
        return [
            'admin' => 'Admin',
            'dataentry' => 'Data Entry',
        ];
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->Where('name', 'Like', '%' . $search . '%')
            ->Where('role', '<>', 'superadmin')
            ->Where('role', '<>', 'donatur')
            ->orWhere('role', 'Like', '%' . $search . '%')
            ->orWhere('team', 'Like', '%' . $search . '%')
            ->orWhere('email', 'Like', '%' . $search . '%')
            ->orWhere('address', 'Like', '%' . $search . '%')
            ->orWhere('city', 'Like', '%' . $search . '%');
    }

    public static function donatur_search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->Where('name', 'Like', '%' . $search . '%')
            ->Where('role', '=', 'donatur')
            ->orWhere('address', 'Like', '%' . $search . '%')
            ->orWhere('city', 'Like', '%' . $search . '%');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function team(): BelongsTo
    {
        return  $this->belongsTo(Team::class);
    }
}
