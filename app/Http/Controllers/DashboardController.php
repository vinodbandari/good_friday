<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function users()
   {
    $users = User::all();
    return view('admin.users.index',compact('users'));
   }

   public function viewusers($id)
   {
    $users = User::find($id);
    return view('admin.users.view',compact('users'));
   }
}
