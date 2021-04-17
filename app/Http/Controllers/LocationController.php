<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

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
}
