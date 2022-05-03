<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id', 'DESC')->paginate(5);
        $response = [
            "success" => true,
            'message' => 'Data is successfully retrieved',
            'data' => $user,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function view($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        if (is_null($user)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'user_role' => $request->get('user_role'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            ]);
        $user = User::find($id);
        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $user,
        ]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
            'address' => 'required',
            'user_role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'user_role' => $request->get('user_role'),
        ]);

        return response()->json([
            "success" => true,
            "message" => "Data successfully created.",
            "data" => $user,
        ]);
    }
    public function delete($id)
    {
        $deletedRows = User::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    "success" => false,
                    "message" => "Invalid Email or Password.",
                ],422);
            }
        } catch (JWTException $e) {
            return response()->json([
                "success" => false,
                "message" => "Failed Create Token.",
            ],500);
        }
        $user = User::where('email', $request->only('email'))->firstOrFail();
        return response()->json([
            "success" => true,
            "message" => "Data successfully retrieved.",
            // "data" => $user,
            "token" => $token,
        ]);
        // return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'user_role' => 'member',
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    "success" => false,
                    "message" => "User Not Found.",
                ],404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                "success" => false,
                "message" => "Token is Expired.",
            ],403);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                "success" => false,
                "message" => "Token is Invalid.",
            ],403);
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                "success" => false,
                "message" => "Token is Absent.",
            ],403);
        }
        return response()->json(compact('user'));
    }
}
