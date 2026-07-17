<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\CareerPlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CareerPlanController extends Controller
{
    public function __construct(protected CareerPlanService $careerPlanService) {}

    // php artisan tinker -> App\Models\User::first()->createToken('postman-token')->plainTextToken;
    public function generate(Request $request): JsonResponse
    {
        $user = $request->user();

        try {
            $careerPlan = $this->careerPlanService->generateForUser($user);

            return response()->json([
                'message' => 'Career gap analysis started in the background.',
                'career_plan' => $careerPlan,
            ], 202);
        } catch (\Exception $e) {
            $statusCode = in_array($e->getCode(), [400, 401]) ? $e->getCode() : 500;
            return response()->json(['message' => $e->getMessage()], $statusCode);
        }
    }

    /**
     * Display the authenticated user's active career plan.
     */
    public function active(Request $request): JsonResponse
    {
        $user = $request->user();
        $careerPlan = $user->careerPlans()->active()->latest()->first();

        if (!$careerPlan) {
            return response()->json(['message' => 'No active career plan found.'], 404);
        }

        return response()->json([
                'message' => 'Active career plan found.',
                'career_plan' => $careerPlan,
            ], 200);
    }
}
