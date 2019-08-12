<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Chat;
class CanJoinRoom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $path = explode('/', $request->path());

        if(Chat::find($path[1]) !== null){
            $users = DB::table('chat_user')->where('chat_id', $path[1])->pluck('user_id');
            if(in_array(auth()->user()->id, $users->toArray()))
            {
                return $next($request);
            }
            else{
                abort('403'); //Forbidden
            }
        }
        else{
            abort('404'); //Not Found
        }

    }
}
