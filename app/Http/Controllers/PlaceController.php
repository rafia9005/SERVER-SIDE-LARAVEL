<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    public function index()
    {
        $place = Place::all();

        if (!$place) {
            return response()->json(['message' => 'No places found']);
        }

        return PlaceResource::collection($place);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'image_path' => 'required',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $place = new Place();

        $place->name = $request->name;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $imagePath = $request->file('image_path')->store('public/image/place');
        $place->image_path = '/image/place/' . $request->file('image_path')->hashName();
        $place->description = $request->description;
        $place->save();

        return response()->json([
            'success' => true,
            'status_code' => 201,
            'data' => $place,
        ], 201);
    }
    public function delete(Request $request, $id)
    {
        $place = Place::find($id);


        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $place->delete();
        return response()->json(['success' => 'Place deleted successfully'], 200);
    }
    public function show(Request $request, $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        return response()->json(['data' => $place], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
            'image_path' => 'nullable|image',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $place->name = $request->name;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;

        // image update
        $imagePath = $request->file('image_path')->store('public/image/place');
        $place->image_path = $imagePath;
        $place->description = $request->description;

        $place->save();

        return response()->json([
            'message' => 'Place updated successfully',
            'status' => 200,
            'data' => $place
        ], 200);
    }


}
