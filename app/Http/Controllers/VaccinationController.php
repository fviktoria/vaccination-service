<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    //
	public function getAll() {
		$vaccinations = Vaccination::with(['location'])->get();
		return $vaccinations;
	}

	public function getById($id) {
		$vaccination = Vaccination::where('id', $id)->with(['location'])->get()->first();
		return $vaccination;
	}

	/**
	 * retrieve vaccination appointments by location
	 * @param $locationId
	 * @return mixed
	 */
	public function getByLocation($locationId) {
		$vaccinations = Vaccination::where('location_id', $locationId)->with(['location'])->get();
		return $vaccinations;
	}
}
