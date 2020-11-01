<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class Counter{

    private $timeout;

    public function __construct(int $timeout)
    {
        $this->timeout = $timeout;
    }

    public function increment(string $key):int {

        $sessionId = session()->getId();
        $counterKey= "{$key}-CounterKey";  //$post->id
        $usersKey  = "{$key}-UserCounter";  //$post->id


        $users = Cache::get($usersKey,[]);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lasVisit){
            if ($now->diffInMinutes($lasVisit)>=$this->timeout){    //(last visit website >= 1) => --$diffrence
                //dd($now->diffInMinutes($lasVisit)); //last visit website
                $diffrence--;
            }else{
                $usersUpdate[$session] = $lasVisit;
            }
        }
        //!array_key_exists($sessionId,$users)   => return True Or False
        //$now->diffInMinutes($users[$sessionId] => add increment one minute ++1

        if (!array_key_exists($sessionId,$users) || $now->diffInMinutes($users[$sessionId])>=$this->timeout){
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;

        Cache::forever($usersKey,$usersUpdate);

        if (!Cache::has($counterKey)){
            Cache::forever($counterKey,1);  //forever() => add element is the memcache temporary "limit time"
        }else{
            Cache::increment($counterKey,$diffrence);  //$counterKey == post_id
        }

        $counter = Cache::get($counterKey);

        return $counter;
    }
}
