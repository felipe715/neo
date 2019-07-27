<?php

namespace App\Http\Middleware;

use App\Statistic;
use Closure;

class Statistics
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
        $statistic = new Statistic();
        $statistic->type = $request->method();
        $statistic->path = $request->path();
        $statistic->save();

        return $next($request);
    }
}
