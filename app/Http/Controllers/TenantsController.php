<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TenantsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tenants",
     *     tags={"Tenants"},
     *     summary="Get list of tenants",
     *     description="Returns a list of tenants",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
    */
    public function index()
    {
        $baseUrl = config('saas.authentication-service') ;        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get($baseUrl . '/api/tenants');

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'tenants' => $response->json()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'error' => 'Failed to retrieve tenants',
            'details' => $response->json()
        ], $response->status());
    }

    /**
     * @OA\Get(
     *     path="/api/tenants/{uuid}",
     *     tags={"Tenants"},
     *     summary="Get tenant information by UUID",
     *     description="Fetches a specific tenant using the UUID as an identifier",
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         description="UUID of the tenant to fetch",
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tenant details retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
     *             @OA\Property(property="name", type="string", example="Tenant Name"),
     *             @OA\Property(property="email", type="string", example="tenant@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tenant not found"
     *     )
     * )
    */
    public function show(string $uuid)
    {
        $baseUrl = config('saas.authentication-service') ;        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get($baseUrl . '/api/tenants/' . $uuid);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'tenant' => $response->json()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'error' => 'Failed to retrieve tenant',
            'details' => $response->json()
        ], $response->status());
    }

    public function create()
    {
        
    }
}
