<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class TryRedisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function visit(Request $request, $name = null)
    {
        if (Redis::EXISTS('visits')) {
            Redis::INCR('visits');
        } else {
            Redis::SET('visits', 1, 'EX', 10);
        }
        Redis::EXPIRE('visits', 10);
        $response = 'within 10 seconds vist: ' . Redis::GET('visits');

        return (new Response($response))->header('Content-Type', 'text/plain');
    }

    public function list(Request $request, $operation = null, $content = null)
    {
        switch ($operation) {
            case 'lpush':
                if (is_null($content)) {
                    throwException(new \Exception('nothing to push'));
                }
                Redis::LPUSH('mylist', $content);
                break;
            case 'rpush':
                if(is_null($content)) {
                    throwException(new \Exception('nothing to push'));
                }
                Redis::RPUSH('mylist', $content);
                break;
            case 'lpop':
                Redis::LPOP('mylist');
                break;
            case 'rpop':
                Redis::RPOP('mylist');
                break;
        }

        $content = Redis::LRANGE('mylist', 0, -1);
        $response = implode(', ', $content);

        return (new Response($response))->header('Content-Type', 'text/plain');
    }
}