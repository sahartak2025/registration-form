<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CountryResource;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function getCountries(): JsonResponse
    {
        $countriesList = Country::query()->get();

        return response()->json([
            'count' => $countriesList->count(),
            'items' => CountryResource::collection($countriesList)
        ]);
    }
}
