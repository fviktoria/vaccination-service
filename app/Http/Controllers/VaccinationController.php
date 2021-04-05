<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
	 */
	public function getByLocation($locationId) {
		$vaccinations = Vaccination::where('location_id', $locationId)->with(['location'])->get();
		return $vaccinations;
	}

	public function save(Request $request): JsonResponse {
		//$request = $this->parseRequest($request);

		DB::beginTransaction();
		try {
			$vaccination = Vaccination::create($request->all());

			// save location
			if (isset($request['location_id'])) {
				$location = Location::where('id', $request['location_id'])->get()->first();
				$vaccination->location()->associate($location);
			}

			DB::commit();
			return response()->json($vaccination, 201);
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json('saving vaccination failed: ' . $e->getMessage(), 420);
		}
	}

	/*	public function update (Request $request, string $isbn) : JsonResponse {
			DB::beginTransaction();
			try {
				$book = Book::with(['authors', 'images', 'user'])->where('isbn', $isbn)->first();

				if ($book != null) {
					$request = $this->parseRequest($request);
					$book->update($request->all());

					$book->images()->delete();

					// update images
					if (isset($request['images']) && is_array($request['images'])) {
						foreach ($request['images'] as $img) {
							$image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
							$book->images()->save($image);
						}
					}

					// update authors
					$ids = [];
					if (isset($request['authors']) && is_array($request['authors'])) {
						foreach ($request['authors'] as $auth) {
							array_push($ids, $auth['id']);
						}
					}

					$book->authors()->sync($ids);
					$book->save();
				}

				DB::commit();
				$book1 = Book::with(['authors', 'images', 'user'])->get();
				return response()->json($book1, 201);

			} catch (\Exception $e) {
				DB::rollBack();
				return response()->json("updating book failed: " . $e->getMessage(), 420);
			}
		}

		public function delete (string $isbn) : JsonResponse {
			$book = Book::where('isbn', $isbn)->first();

			if ($book != null) {
				$book->delete();
			} else {
				throw new \Exception("Book doesn't exist.");
			}

			return response()->json("Book with isbn ". $isbn . " deleted successfully.", 201);
		}*/

	/**
	 * modify / convert values if needed
	 */

	private function parseRequest(Request $request): Request {

		// get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"

		$date = new \DateTime($request->date);

		$request['date'] = $date;

		return $request;

	}
}
