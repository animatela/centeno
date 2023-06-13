<?php

namespace App\Http\Controllers;

use Idat\Centeno\Workshop\Services\VehicleService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomerVehicleController extends Controller
{
    public function __construct(
        private readonly VehicleService $vehicleService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request, string $customer): Response
    {
        return Inertia::render('Vehicles/List', [
            'vehicles' => $this->vehicleService->list($customer),
        ]);
    }
}
