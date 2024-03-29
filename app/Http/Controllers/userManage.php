<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class userManage extends Controller
{
    public function adduser(Request $request)
	{
        $adminpass = getMemberDetail(auth()->id())->password;
        if (Hash::check($request->input('admin_password'), $adminpass))
        {
        if($request->input('new_password') == $request->input('confirm_password'))
		{
			$newpassword = Hash::make($request->input('new_password'));
				DB::table('users')->insert([
                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'mobile'=>'',
                    'business'=>'',
                    'category'=>'',
                    'password'=>$newpassword,
                    'status'=>'1',
                    'pic'=>'default.jpg',
                    'is_admin'=>'0',
                    'pass_changed'=>'1',
                    'created_at'=> date("Y-m-d H:i:s")]);
                    return redirect(url()->previous())->with('message', 'Added Sucessfully');
			}
			else
			{
				return redirect(url()->previous())->with('error', 'Password Dosent Match');
			}
        }
        else
        {
            return redirect(url()->previous())->with('error', 'Incorrect Admin Password');
        }
	
    }
    public function edituser(Request $request)
	{
        $admin = getMemberDetail(auth()->id());
        $adminpass = $admin->password;
        if (Hash::check($request->input('admin_password'), $adminpass))
        {
        if($request->input('new_password') == $request->input('confirm_password'))
		{
			$newpassword = Hash::make($request->input('new_password'));

				DB::table('users')
                ->where('id', $request->input('id'))
                ->update([
                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'password'=>$newpassword,
                    'updated_at'=> date("Y-m-d H:i:s")]);

            // $a= array();
            // array_push($a, $adminpass);
            // array_push($a, $newpassword);
            // dd($a);
            if($admin->id == $request->input('id'))
            {
                Auth::logout();
                return redirect('/login');
            }
            return redirect(url()->previous())->with('message', 'Edit Sucessfully');

			}
			else
			{
				return redirect(url()->previous())->with('error', 'Password Dosent Match');
			}
        }
        else
        {
            return redirect(url()->previous())->with('error', 'Incorrect Admin Password');
        }
	}
}
		