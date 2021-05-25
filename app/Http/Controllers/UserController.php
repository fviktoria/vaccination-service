<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::with(['vaccination'])->get();
        return $users;
    }

    public function getPatientsByVaccination($id)
    {
        $users = User::with(['vaccination', 'vaccination.location'])->where([['isAdmin', '=', false], ['vaccination_id', '=', $id]])->get();
        return $users;
    }

    public function cancelAppointment($id)
    {
        DB::beginTransaction();
        try {
            $user = User::with(['vaccination', 'vaccination.location'])->where('id', $id)->first();

            if ($user) {
                $user->vaccination()->dissociate();
                $user->vaccination_id = null;
                $user->save();
            }

            DB::commit();
            $user1 = User::with(['vaccination'])->where('id', $id)->first();
            return response()->json($user1, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("cancelling appointment failed: " . $e->getMessage(), 420);
        }
        return $user;
    }

    public function getById($id)
    {
        $user = User::with(['vaccination', 'vaccination.location'])->where('id', $id)->first();
        return $user;
    }

    public function setVaccinationStatus(Request $request, string $id)
    {
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

    public function setVaccinationAppointment(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $request->userId)->first();
            $vaccination = Vaccination::where('id', $request->vaccinationId)->withCount(['users'])->first();

            if ($user != null && $vaccination->users_count < $vaccination->maxPatients) {
                $user->vaccination()->associate($vaccination);
                $user->save();

                DB::commit();
                $user1 = User::with(['vaccination'])->where('id', $request->userId)->first();
                return response()->json($user1, 201);
            } else {
                DB::rollBack();
                return response()->json("updating vaccination status failed: max patients reached", 420);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating vaccination status failed: " . $e->getMessage(), 420);
        }
    }

    public function save(Request $request): JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $user = User::create($request->all());

            DB::commit();
            return response()->json($user, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('saving user failed: ' . $e->getMessage(), 420);
        }
    }

    public function update (Request $request, string $id) : JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->first();

            if ($user != null) {
                $user->update($request->all());
                $user->save();
            }

            DB::commit();
            $user1 = User::where('id', $id)->first();
            return response()->json($user1, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating user failed: " . $e->getMessage(), 420);
        }
    }

    public function delete (string $id) : JsonResponse {
        $user = User::where('id', $id)->first();

        if ($user != null) {
            $user->delete();
        } else {
            throw new \Exception("user doesn't exist.");
        }

        return response()->json("user with ID ". $id . " deleted successfully.", 201);
    }

    private function parseRequest(Request $request): Request {

        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"

        $date = new \DateTime($request->date);

        $request['date'] = $date;

        return $request;

    }
}
