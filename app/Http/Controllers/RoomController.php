<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $room = Room::where('availability', '>', 0);
        if ($request->has('name')) {
            $room->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('city')) {
            $room->where('city', 'LIKE', '%'.$request->city.'%');
        }
        if ($request->has('price')) {
            $price = explode('-', $request->price);
            if (count($price) > 2) {
                abort(404);
            }
            if (count($price) === 1) {
                $price[1] = $price[0];
                $price[0] = '';
            }
            if (empty($price[1])) {
                $price[1] = '1000000000';
            }
            array_walk($price, function ($item) {
                return (int) $item;
            });
            $room->whereBetween('price', $price);
        }
        if ($request->has('sort_by') && in_array($request->sort_by, ['price', 'availability'])) {
            $room->orderBy($request->sort_by, 'desc');
        }

        return $room->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->type !== User::ADMIN_ROLE) {
            abort(404);
        }
        $dataToStore = array_merge($request->all(), ['user_id' => $request->user()->id]);
        return Room::create($dataToStore);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Room::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->type !== User::ADMIN_ROLE) {
            abort(404);
        }
        $room = Room::findOrFail($id);
        if ($room->user->id !== $request->user()->id) {
            abort(404);
        }
        $room->update($request->all());

        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->user()->type !== User::ADMIN_ROLE) {
            abort(404);
        }
        $room = Room::findOrFail($id);
        if ($room->user->id !== $request->user()->id) {
            abort(404);
        }
        $room->delete();
        return Room::all();
    }

    public function book(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        if ($room->user->id === $request->user()->id) {
            abort(404);
        }
        if ($request->user()->credits < 5) {
            abort(404);
        }
        $room->decrement('availability');
        $user = User::findOrFail($request->user()->id);
        $admin = User::findOrFail($room->user->id);
        $user->decrement('credits', 5);
        $admin->increment('credits', 5);

        return $room;
    }
}
