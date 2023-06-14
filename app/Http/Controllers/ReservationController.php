<?php

namespace App\Http\Controllers;

use App\Http\Requests\Workshop\Reservations\StoreReservationRequest;
use App\Http\Requests\Workshop\Reservations\UpdateReservationRequest;
use Idat\Centeno\Workshop\Enums\Currency;
use Idat\Centeno\Workshop\Repositories\ReservationRepository;
use Idat\Centeno\Workshop\Repositories\VehicleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReservationController extends Controller
{
    public function __construct(
        private readonly VehicleRepository $vehicle,
        private readonly ReservationRepository $reservation,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Reservations/List', [
            'reservations' => $this->reservation->list(
                $request->user()->customer->id
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Reservations/Create', [
            'customer' => $request->user()->customer,
            'currencies' => Currency::asSelectArray(),
            'vehicles' => $this->vehicle->list(
                $request->user()->customer->id
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $this->reservation->create($request->all());

        return Redirect::route('reservations');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id): Response
    {
        return Inertia::render('Reservations/Edit', [
            'reservation' => $this->reservation->find($id),
            'currencies' => Currency::asSelectArray(),
            'vehicles' => $this->vehicle->list(
                $request->user()->customer->id
            ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, string $id): RedirectResponse
    {
        $this->reservation->update($id, $request->all());

        return Redirect::route('reservations.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ($request->has('force')) {
            $this->reservation->forceDelete($id);
        }

        $this->reservation->delete($id);

        return Redirect::route('reservations');
    }
}
