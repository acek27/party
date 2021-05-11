<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GuestController extends Controller
{

    public function index()
    {
        return Inertia::render('Guest/Index', [
            'filters' => Request::all('search', 'detail', 'trashed'),
            'guest' => Guest::filter(Request::only('search', 'detail', 'trashed'))
                ->paginate()
                ->withQueryString()
                ->through(function ($guest) {
                    return [
                        'id' => $guest->id,
                        'name' => $guest->name,
                        'address' => $guest->address,
                        'currency' => $guest->currency,
                        'rice' => $guest->rice,
                        'sugar' => $guest->sugar,
                        'other' => $guest->other,
                        'detail' => $guest->detail_id,
                        'user' => $guest->user_id,
                        'deleted_at' => $guest->deleted_at,
                    ];
                }),
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function restore(Guest $tamu)
    {
        $tamu->restore();

        return Redirect::back()->with('success', 'Guest restored.');
    }
}
