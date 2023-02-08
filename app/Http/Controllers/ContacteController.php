<?php

namespace App\Http\Controllers;

use App\Models\Contacte;
use App\Http\Requests\StoreContacteRequest;
use App\Http\Requests\UpdateContacteRequest;

class ContacteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContacteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContacteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacte  $contacte
     * @return \Illuminate\Http\Response
     */
    public function show(Contacte $contacte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacte  $contacte
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacte $contacte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContacteRequest  $request
     * @param  \App\Models\Contacte  $contacte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContacteRequest $request, Contacte $contacte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacte  $contacte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacte $contacte)
    {
        //
    }
}
