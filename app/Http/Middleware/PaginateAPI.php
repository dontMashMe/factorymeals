<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaginateAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
	{
		$response = $next($request);
		$data = $response->getData(true);
        
        //format links
		if (isset($data['meta'], $data['meta']['links'])) {
			unset($data['meta']['links']);
		}
        if (isset($data['links']['first'])) {
            unset($data['links']['first']);
        }
        if (isset($data['links']['last'])) {
            unset($data['links']['last']);
        }
        $data['links']['self'] = $request->fullUrl();

        // hide path
        if (isset($data['meta']['path'])) {
            unset($data['meta']['path']);
        }

        if (isset($data['meta']['from'])) {
            unset($data['meta']['from']);
        }

        // pagination related 
        if (isset($data['meta']['last_page'])) {
            $data['meta']['totalPages'] = $data['meta']['last_page'];
        } else {
            $data['meta']['totalPages'] = 0;
        }
        
        if (isset($data['meta']['last_page'])) {
            unset($data['meta']['last_page']);
        }

        if (isset($data['meta']['to'])) {
            unset($data['meta']['to']);
        }

        if (isset($data['meta']['total'])) {
            $data['meta']['totalItems'] = $data['meta']['total'];
            unset($data['meta']['total']);
        }

        if (isset($data['meta']['per_page'])) {
            $data['meta']['itemsPerPage'] = $data['meta']['per_page'];
            unset($data['meta']['per_page']);
        }

        if (isset($data['meta']['current_page'])) {
            $data['meta']['currentPage'] = $data['meta']['current_page'];
            unset($data['meta']['current_page']);
        }
        
		$response->setData($data);
		return $response;
	}
}
