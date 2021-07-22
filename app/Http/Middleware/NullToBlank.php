<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
class NullToBlank
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $output = $next($request);
        if($output instanceof Model) {
            $modelAsArray = $output->toArray();

            array_walk_recursive($modelAsArray, function (&$item, $key) {
                $item = $item === null ? '' : $item;
            });

            return response()->json($modelAsArray);
        }

        return $output;
    }
}
