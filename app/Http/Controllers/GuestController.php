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


    public function create()
    {
        return Inertia::render('Guest/Create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit(Guest $guest)
    {
        return Inertia::render('Guest/Edit', [
            'guest' => [
                'id' => $guest->id,
                'name' => $guest->name,
                'address' => $guest->address,
                'money' => $guest->money,
                'rice' => $guest->rice,
                'sugar' => $guest->sugar,
                'other' => $guest->other,
                'detail' => $guest->detail_id,
                'user' => $guest->user_id,
                'deleted_at' => $guest->deleted_at,
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }


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
