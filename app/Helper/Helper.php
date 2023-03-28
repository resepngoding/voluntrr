<?php

use App\Models\Account;
use App\Models\AccountJournal;
use App\Models\Fiscalyear;
use App\Models\Setting;
use App\NullSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


if (!function_exists('moneyFormat')) {
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return void
     */
    function moneyFormat($str)
    {
        return number_format($str, '0', '', '.');
    }
}



if (!function_exists('AccountName')) {
    function AccountName($accountCode)
    {
        // $parent_account_code = $accountCode[0];
        $account_name = DB::table('accounts')
            ->where('id', $accountCode)
            ->select('name')
            ->pluck('name')
            ->first();
        return $account_name;
    }
}

if (!function_exists('UserName')) {
    function UserName($user_id)
    {
        // $parent_account_code = $accountCode[0];
        $user_name = DB::table('users')
            ->where('id', $user_id)
            ->select('name')
            ->pluck('name')
            ->first();
        return $user_name;
    }
}
