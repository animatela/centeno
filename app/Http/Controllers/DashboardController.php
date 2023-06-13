<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'canMakeReservation' => (bool) $request->user()->customer,
            'customerId' => $request->user()->customer?->id,
        ]);
    }
}
