<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function getAll() {
		$locations = Location::all();
		return $locations;
	}

	public function getById($id) {
		$location = Location::where('id', $id)->first();
		return $location;
	}


    public function save(Request $request): JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $location = Location::create($request->all());

            DB::commit();
            return response()->json($location, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('saving location failed: ' . $e->getMessage(), 420);
        }
    }

    public function update (Request $request, string $id) : JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $location = Location::where('id', $id)->first();

            if ($location != null) {
                $location->update($request->all());
                $location->save();
            }

            DB::commit();
            $location1 = Location::where('id', $id)->first();
            return response()->json($location1, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating location failed: " . $e->getMessage(), 420);
        }
    }

    public function delete (string $id) : JsonResponse {
        $location = Location::where('id', $id)->first();

        if ($location != null) {
            $location->delete();
        } else {
            throw new \Exception("location doesn't exist.");
        }

        return response()->json("location with ID ". $id . " deleted successfully.", 201);
    }

    private function parseRequest(Request $request): Request {

        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"

        $date = new \DateTime($request->date);

        $request['date'] = $date;

        return $request;

    }
}
