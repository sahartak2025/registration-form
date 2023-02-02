<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function createUser(UserCreateRequest $userCreateRequest): JsonResponse
    {
        UserFacade::createUser($userCreateRequest->validated());

        return response()->json([]);
    }
}
