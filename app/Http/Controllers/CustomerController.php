<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return Inertia::render('Customer/Index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request, CustomerService $service)
    {
        // $validated = $request->validated();
        // dd($validated);

        $service->create($request->validated());

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $customers = Customer::find($id);

        return Inertia::render('Customer/CreateUpdate', ['customers' => $customers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer, CustomerService $service)
    {

        // dd($customer->id, $customer->exists, $request->validated());
        $service->update($customer, $request->validated());

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
    //   dd($customer);
    $customer->delete();

    return redirect()
            ->route('customer.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
