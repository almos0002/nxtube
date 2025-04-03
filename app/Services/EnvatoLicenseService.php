<?php

namespace App\Services;

use App\Models\License;
use Exception;
use Illuminate\Support\Facades\Http;

class EnvatoLicenseService
{
    protected $personalToken;
    
    public function __construct()
    {
        $this->personalToken = 'riCzniQFlbKqYeyaPeoL9Ohg7oUn6oZl';
    }
    
    public function verifyPurchaseCode($code)
    {
        // Trim whitespace
        $code = trim($code);
        
        // Validate format
        if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
            throw new Exception("Invalid purchase code format");
        }
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->personalToken,
                'User-Agent' => 'Purchase code verification script'
            ])->get("https://api.envato.com/v3/market/author/sale", [
                'code' => $code
            ]);
            
            if ($response->status() === 404) {
                throw new Exception("Invalid purchase code");
            }
            
            if ($response->status() === 403) {
                throw new Exception("The personal token is missing required permissions");
            }
            
            if ($response->status() === 401) {
                throw new Exception("Invalid personal token");
            }
            
            if ($response->status() !== 200) {
                throw new Exception("API error: " . $response->status());
            }
            
            $data = $response->json();
            
            // Store or update license in database
            $license = License::updateOrCreate(
                ['purchase_code' => $code],
                [
                    'buyer_username' => $data['buyer'],
                    'item_id' => $data['item']['id'],
                    'item_name' => $data['item']['name'],
                    'domain' => request()->getHost(),
                    'supported_until' => $data['supported_until'],
                    'is_active' => true
                ]
            );
            
            return $license;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function isLicenseValid()
    {
        $license = License::where('domain', request()->getHost())
            ->where('is_active', true)
            ->first();
            
        return $license !== null;
    }
}
