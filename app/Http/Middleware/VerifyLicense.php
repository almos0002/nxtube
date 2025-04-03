<?php

namespace App\Http\Middleware;

use App\Services\EnvatoLicenseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyLicense
{
    protected $licenseService;
    
    /**
     * Create a new middleware instance.
     */
    public function __construct(EnvatoLicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->licenseService->isLicenseValid()) {
            return redirect()->route('license.verify');
        }
        
        return $next($request);
    }
}
