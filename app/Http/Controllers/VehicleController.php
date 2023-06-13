<?php

namespace App\Http\Controllers;

use App\Http\Requests\Workshop\Vehicles\StoreVehicleRequest;
use App\Http\Requests\Workshop\Vehicles\UpdateVehicleRequest;
use Idat\Centeno\Workshop\Enums\FuelType;
use Idat\Centeno\Workshop\Enums\TransmissionType;
use Idat\Centeno\Workshop\Repositories\VehicleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    public function __construct(
        private readonly VehicleRepository $vehicleRepository,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Vehicles/List', [
            'vehicles' => $this->vehicleRepository->list(
                $request->user()->customer->id
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Vehicles/Create', [
            'customer' => $request->user()->customer,
            'fuelTypes' => FuelType::asSelectArray(),
            'transmissionTypes' => TransmissionType::asSelectArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $this->vehicleRepository->create($request->all());

        return Redirect::route('vehicles');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        return Inertia::render('Vehicles/Edit', [
            'vehicle' => $this->vehicleRepository->find($id),
            'fuelTypes' => FuelType::asSelectArray(),
            'transmissionTypes' => TransmissionType::asSelectArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, int $id): RedirectResponse
    {
        $this->vehicleRepository->update($id, $request->all());

        return Redirect::route('vehicles.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {

        if ($request->has('force')) {
            $this->vehicleRepository->forceDelete($id);
        }

        $this->vehicleRepository->delete($id);

        return Redirect::route('vehicles.edit');
    }
}
