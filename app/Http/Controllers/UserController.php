<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\User;

class UserController extends Controller
{
    public function store(Request $request)
    {

      $request->validate([
          'email' => 'required|email:rfc,dns',
          'first_name' => 'required',
          'last_name' => 'required',
          'status' => 'required'
      ]);

      $user = new User([
        'email' => $request->get('email'),
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'status' => $request->get('status')
      ]);

      $user->save();
      return response()->json('success');
    }

    public function index()
    {
      $data = User::paginate(10);
      return new UserCollection($data);
      //return response()->json($data);
    }

    public function edit($id)
    {
      $user = User::find($id);
      return response()->json($user);
    }

    public function update($id, Request $request)
    {
      $request->validate([
          'id' => 'required',
          'email' => 'required|email:rfc,dns',
          'first_name' => 'required',
          'last_name' => 'required',
          'status' => 'required'
      ]);

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

    public function filter(Request $request)
    {
      //print_r($request->get('email'));
      return User::filter($request)->get();
    }
}
