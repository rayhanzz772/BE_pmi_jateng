<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
        'c_password' => 'required|same:password',
    ]); 

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation Error.',
            'errors' => $validator->errors()
        ], 422);
    }

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);
    $token = $user->createToken('MyApp')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'User registered successfully.',
        'data' => [
            'token' => $token,
            'name' => $user->name,
        ]
    ], 201);
}

   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $request->user()->createToken('MyApp')->plainTextToken;
    
            return response()->json([
                'success' => true,
                'message' => 'User login successfully.',
                'data' => [
                    'token' => $token,
                    'name' => $user->name,
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
                'errors' => ['error' => 'Unauthorized']
            ], 401);
        }
    } } 
    