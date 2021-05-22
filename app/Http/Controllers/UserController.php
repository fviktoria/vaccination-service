<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
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

    public function setVaccinationAppointment(Request $request) {
        DB::beginTransaction();
        try {
            $user = User::where('id', $request->userId)->first();
            $vaccination = Vaccination::where('id', $request->vaccinationId)->first();

            if ($user != null) {
                $user->vaccination()->associate($vaccination);
                $user->save();
            }

            DB::commit();
            $user1 = User::with(['vaccination'])->where('id', $request->userId)->first();
            return response()->json($user1, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating vaccination status failed: " . $e->getMessage(), 420);
        }
    }
}
