<?php
namespace App\Http\Custom;
use Illuminate\Support\Facades\Redis;
use App\User;

class Helper
{
    public static function loggedUsers($cursor=null, $allResults=array())
    {
        // Zero means full iteration
        if ($cursor==="0"){
            // Get rid of duplicated values caused by redis scan limitations.
            $allResults = array_unique($allResults);
            // Setting users array
            $users = array ();
            // Looping through all results. Inserting each logged user into array.
            foreach($allResults as $result){
                $users[] = User::where('id',Redis::Get($result))->first();
            }
            // Removing duplicate items. (If user has logged in using more than one machine)
            $users = array_unique($users);
            return $users;
        }

        // No $cursor means init
        if ($cursor===null){
            $cursor = "0";
        }

        // The call
        $result = Redis::scan($cursor, 'match', 'users:*');

        // Append results to array
        $allResults = array_merge($allResults, $result[1]);

        // Recursive call until cursor is 0
        return self::loggedUsers($result[0], $allResults);
    }
}