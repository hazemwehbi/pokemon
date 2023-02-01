<?php

namespace App\Repository;

use App\Models\Team;
use Carbon\Carbon;

class Teams
{
    CONST CACHE_KEY ='TEAMS';

    public function all($orderBy)
    {
        //Creating the Key to access the cache with.
        $key='all.{$orderBy}';
        $cacheKey= $this->getCacheKey($key);
        $data = Team::orderBy('created_at', 'DESC')->get();
        //Keep cache for 5 minutes, if asked for it after recreate it.
        return cache()->remember($cacheKey, Carbon::now()->addMinutes(5), function() use($orderBy) {
            return Team::orderBy($orderBy, 'DESC')->get();
        });

    }
    //Creates the Key to access the cache with.
    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY.".$key";
    }


}
