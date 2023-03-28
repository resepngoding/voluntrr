<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'donation_category',
        'is_money',
        'account',
        'money',
        'goods',
        'goods_qty',
        'description',
        'dataentry_id',
        'dataentry_name',
        'team',
        'image',
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->orWhere('donations.team', 'Like', '%' . $search . '%')
            ->orWhere('name', 'Like', '%' . $search . '%')
            ->orWhere('dataentry_name', 'Like', '%' . $search . '%')
            ->orWhere('dataentry_id', 'Like', '%' . $search . '%')
            ->orWhere('goods', 'Like', '%' . $search . '%')
            ->orWhere('donation_category', 'Like', '%' . $search . '%');
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }


    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('donations.team', 'Like', $term)
                // ->orWhere('donations.user_id ', 'Like', $term)
                ->orWhere('goods', 'Like', $term)
                ->orWhere('description', 'Like', $term)
                ->orWhere('money', 'Like', $term)
                ->orWhere('dataentry_name', 'Like', $term);
        });
    }

    public function scopeSelectData($query)
    {
        $query->select('users.name as name', 'users.id as userid',   'donations.date', 'donations.team as team', 'donations.account as account', 'donations.id as donation_id', 'donations.image as image',  'donations.is_money as is_money', 'donations.dataentry_name', 'donations.dataentry_id', 'donations.description', 'donations.money', 'donations.goods', 'donations.goods_qty', 'donations.donation_category');
    }

    public function scopeJoinTables($query)
    {
        $query->join('users', 'donations.user_id', '=', 'users.id');
        // ->join('accounts', 'accounts.id', '=', 'donations.account_id');
    }
}
