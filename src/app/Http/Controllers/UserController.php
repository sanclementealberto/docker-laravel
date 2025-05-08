<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

     public function index()
     {
         $users = User::all();
         return view('users.index', compact('users'));
     }
 
  
     public function show($id)
     {
         $user = User::findOrFail($id);
         return view('users.show', compact('user'));
     }
 
    
     public function edit($id)
     {
         $user = User::findOrFail($id);
         return view('users.edit', compact('user'));
     }
 
     // Guardar cambios
     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string',
             'email' => 'required|email',
             'role' => 'required|in:cliente,taller', 
         ]);
 
         $user = User::findOrFail($id);
         $user->update($request->all());
 
         return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
     }
 
  
     public function destroy($id)
     {
         $user = User::findOrFail($id);
         $user->delete();
 
         return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
     }
}
