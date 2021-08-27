<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\ApiResponder;
use App\User;
class UserController extends BaseController
{
    use ApiResponder;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->successResponse(User::all());
    }

    /**
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'opt_in' => 'required|boolean',
        ];
        $this->validate($request, $rules);

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, $user)
    {
        $rules = [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'max:255',
            'opt_in' => 'boolean',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($user);

        $user->fill($request->All());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);


    }
}
