<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\interfaces\Finance\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    private $Payment;
    public function __construct(PaymentRepositoryInterface $Payment)
    {
        $this->Payment=$Payment;
    }
    public function index()
    {
        return $this->Payment->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Payment->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Payment->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    return $this->Payment->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Payment->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Payment->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Payment->destroy($request);
    }
}
