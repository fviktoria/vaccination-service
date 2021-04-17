<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAll() {
		$users = User::with(['vaccination'])->get();
		return $users;
	}

    public function setVaccinationStatus(Request $request, string $id) {
        DB::beginTransaction();
			try {
				$user = User::with(['vaccination'])->where('id', $id)->first();

				if ($user != null) {
					$user->update($request->all());
				}

				DB::commit();
				$user1 = User::with(['vaccination'])->where('id', $id)->first();
				return response()->json($user1, 201);

			} catch (\Exception $e) {
				DB::rollBack();
				return response()->json("updating vaccination status failed: " . $e->getMessage(), 420);
			}
    }
}
