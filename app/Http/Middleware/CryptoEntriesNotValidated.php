<?php

namespace App\Http\Middleware;

use App\Http\Service\CryptoEntriesService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CryptoEntriesNotValidated
{

    public function __construct(private readonly CryptoEntriesService $service)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');

        if ($model = $this->service->find($id)) {
            if (!$model->result) {
                return $next($request);
            }
        }

        return redirect()->route('home')->with('error', 'l\'entrée Crypto est déjà validée');
    }
}
