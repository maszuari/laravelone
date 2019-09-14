<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
      $user = new User([
        'email' => $request->get('email'),
        'firstname' => $request->get('firstname'),
        'lastname' => $request->get('lastname'),
        'status' => $request->get('status')
      ]);

      $user->save();
      return response()->json('success');
    }

    public function index()
    {
      return new UserCollection(User::all());
    }

    public function edit($id)
    {
      $user = User::find($id);
      return response()->json($user);
    }

    public function update($id, Request $request)
    {
      $user = User::find($id);
      $user->update($request->all());
      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $user = User::find($id);
      $user->delete();
      return response()->json('successfully deleted');
    }
}
