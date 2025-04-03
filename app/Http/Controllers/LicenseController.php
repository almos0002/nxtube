<?php

namespace App\Http\Controllers;

use App\Services\EnvatoLicenseService;
use Exception;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $licenseService;
    
    /**
     * Create a new controller instance.
     */
    public function __construct(EnvatoLicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }
    
    /**
     * Show the license verification form.
     */
    public function showVerificationForm()
    {
        return view('admin.license.verify');
    }
    
    /**
     * Verify the Envato purchase code.
     */
    public function verifyLicense(Request $request)
    {
        $request->validate([
            'purchase_code' => 'required|string'
        ]);
        
        try {
            $license = $this->licenseService->verifyPurchaseCode($request->purchase_code);
            return redirect()->route('dashboard')
                ->with('success', 'License verified successfully!');
        } catch (Exception $e) {
            return back()->withErrors(['purchase_code' => $e->getMessage()]);
        }
    }
}
