<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;

class QueryLog implements TerminableMiddleware {

    public function handle($request, Closure $next)
    {
    	\DB::connection()->enableQueryLog();

        return $next($request);
    }

    public function terminate($request, $response)
    {
    	\Log::debug('=== Start queries ===');

        foreach (\DB::getQueryLog() as $i => $query) {
        	\Log::debug("Query #{$i}", ['query' => $query]);
        }

        \Log::debug('=== End queries ===');
    }

}
