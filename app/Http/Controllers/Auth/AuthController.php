<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Interfaces\Auth\AuthRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ResponseTrait;
    protected $authRepository;


    public function __construct(AuthRepositoryInterface $authRepository, )
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->authRepository->create($request->validated());
            DB::commit();
            return $this->sendResponse($user, 'User register successfully');
        } catch (\Throwable $th) {
            DB::rollback();

            return $this->sendResponse(null, $th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->authRepository->login($request->validated());
            if ($response) {
                return $this->sendResponse($response, 'user login successfully');
            }
            
            return $this->sendError('message', ['Invalid Credentials'], 401);
            
        } catch (\Throwable $th) {
            return $this->sendError('message', [$th->getMessage()], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $this->authRepository->updateProfile($request->all());
        return $this->sendResponse($user, 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->authRepository->updatePassword($request->validated());
        return $this->sendResponse($user, 'Password updated successfully');
    }
}
