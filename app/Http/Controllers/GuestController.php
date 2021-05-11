<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
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
                        'detail_id' => $guest->detail_id,
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

    public function edit($guest)
    {
        $guest = Guest::withTrashed()->find($guest);
        return Inertia::render('Guest/Edit', [
            'guest' => [
                'id' => $guest->id,
                'name' => $guest->name,
                'address' => $guest->address,
                'money' => $guest->money,
                'rice' => $guest->rice,
                'sugar' => $guest->sugar,
                'other' => $guest->other,
                'detail_id' => $guest->detail_id,
                'user' => $guest->user_id,
                'deleted_at' => $guest->deleted_at,
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Guest $guest)
    {
        $guest->delete();

        return Redirect::back()->with('success', 'Contact deleted.');
    }

    public function restore($guest)
    {
        $guest = Guest::withTrashed()->find($guest);
        $guest->restore();

        return Redirect::back()->with('success', 'Guest restored.');
    }
}
