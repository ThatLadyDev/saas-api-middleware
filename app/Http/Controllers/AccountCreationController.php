<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountCreationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/account/create",
     *     summary="Create a new account",
     *     description="This endpoint allows creating a new account with name, email, password, tenant name and user type fields.",
     *     tags={"Accounts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "tenant_name", "user_type"},
     *             @OA\Property(property="name", type="string", example="Julia Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="juliadoe@example.com"),
     *             @OA\Property(property="password", type="string", example="92jer239"),
     *             @OA\Property(property="tenant_name", type="string", example="Codevixens"),
     *             @OA\Property(property="user_type", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Account created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Julia Doe"),
     *             @OA\Property(property="email", type="string", example="juliadoe@example.com"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request data",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Bad Request")
     *         ),
     *     )
     * )
    */
    public function create()
    {
        $baseUrl = config('saas.authentication-service') ;        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post($baseUrl . '/api/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'tenant_name' => '',
            'user_type' => ''
        ]);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'tenant' => $response->json()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'error' => 'Account creation unsuccessful',
            'details' => $response->json()
        ], $response->status());
    }
}
