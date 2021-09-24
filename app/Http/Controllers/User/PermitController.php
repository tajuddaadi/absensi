<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermitResource;
use App\Http\Controllers\Auth\AuthController;
use App\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // list all Permit created by employee
    public function index()
    {
        $auth_controller = new AuthController;
        $user = $auth_controller->me();
        if ($user != null) {
            return PermitResource::collection(Permit::where('user_id', $user->id)->paginate(5));
        } else {
            return response()->json(['message' => 'check your request!'], 422);
        }
    }

    // create Permit
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'date_permit' => 'required',
        ]);

        $auth_controller = new AuthController;
        $user = $auth_controller->me();

        if ($user != null) {
            $Permit = Permit::create([
                'user_id' => $user->id,
                'date_permit' => $request->date_permit,
                'note' => $request->note,
                'status' => $request->status,
            ]);

            return new PermitResource($Permit);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'date_permit' => 'required',
        ]);

        $auth_controller = new AuthController;
        $user = $auth_controller->me();
        if ($user != null) {
            $permit = Permit::where('id', $id)->update([
                'user_id' => $user->id,
                'date_permit' => $request->date_permit,
                'note' => $request->note,
                'status' => $request->status,
            ]);

            return new PermitResource($permit);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    // view applied Permit
    public function view_permit($id)
    {
        if ($id != null) {
            return PermitResource::collection(Permit::where('id', $id)->first());
        } else {
            return response()->json(['message' => 'check your request!'], 422);
        }
    }
}
