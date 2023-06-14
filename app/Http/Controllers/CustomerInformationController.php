<?php

namespace App\Http\Controllers;

use Idat\Centeno\Workshop\Enums\DocumentType;
use Idat\Centeno\Workshop\Enums\Gender;
use Idat\Centeno\Workshop\Repositories\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CustomerInformationController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService
    ) {}

    /**
     * Display the customer's information form.
     */
    public function create(Request $request): Response
    {
        $customer = $this->customerService->findByUserId(
            $request->user()->id
        );

        return Inertia::render('Customer/Create', [
            'customer' => $customer,
            'genders' => Gender::asSelectArray(),
            'document_types' => DocumentType::asSelectArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->customerService->create(
            $request->all()
        );

        return Redirect::route('customer.edit');
    }

    /**
     * Display the customer's information form.
     */
    public function edit(Request $request): Response
    {
        $customer = $this->customerService->findByUserId(
            $request->user()->id
        );

        return Inertia::render('Customer/Edit', [
            'customer' => $customer,
            'genders' => Gender::asSelectArray(),
            'document_types' => DocumentType::asSelectArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->customerService->update(
            $id,
            $request->all()
        );

        return Redirect::route('customer.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        if ($request->has('force')) {
            $this->customerService->forceDelete($id);
        }

        $this->customerService->delete($id);

        return Redirect::route('dashboard');
    }
}
