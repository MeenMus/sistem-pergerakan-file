<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Application;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewuser()
    {
        $users = User::where('role_id', '!=', '1')->get();
        return view('usercontrol', compact('users'));
    }

    public function rolecontrol()
    {
        $id = request('id');

        $role = User::where('id', '=', $id)->pluck('role_id')->first();

        if ($role == 2) {
            User::where('id', '=', $id)->update(['role_id' => 3]);
        } else {
            User::where('id', '=', $id)->update(['role_id' => 2]);
        }

        return redirect()->back();
    }

    public function createuser()
    {

        $staffid = request('staff_id');
        $email = request('email');

        if (User::whereIn('staff_id', array($staffid))->exists()) {
            session()->flash('dupuser');
            return redirect()->back();
        }

        if (User::whereIn('email', array($email))->exists()) {
            session()->flash('dupuser');
            return redirect()->back();
        }

        $attributes = array(
            ('staff_id') => request('staff_id'),
            ('name') => request('name'),
            ('email') => request('email'),
            ('password') => Hash::make(request('password')),
            ('role_id') => (3),
        );

        User::create($attributes);

        session()->flash('usercreated');
        return redirect()->back();
    }

    public function deleteuser()
    {

        $id = request('id');

        User::where('id', '=', $id)->delete();
        $files = Application::where('applicant_id', '=', request('staff_id'))->pluck('file_id');


        foreach ($files as $file) {

            $status = Application::where('file_id', '=', $file)->pluck('status')->first();

            if ($status == "NEW") {
                File::where('id', '=', $file)->update(['file_status' => 1]);
            }
            if ($status == "CHECKED OUT") {
                File::where('id', '=', $file)->update(['file_status' => 1]);
            }
        }

        Application::where('applicant_id', '=', request('staff_id'))->delete();

        session()->flash('userdeleted');
        return redirect()->back();
    }

    public function getuser($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        return view('edit-user', compact('user'));
    }

    public function editid($id)
    {
        if (User::where('staff_id', '=', request('staff_id'))->exists()) {
            session()->flash('dupuser');
            return redirect()->back();
        }

        $staffid = User::where('id','=',$id)->pluck('staff_id');

        Application::where('applicant_id', '=', $staffid)->update(['applicant_id' => request('staff_id')]);        

        User::where('id', '=', $id)->update(['staff_id' => request('staff_id')]);
        session()->flash('useredited');
        return redirect()->back();
    }

    public function editname($id)
    {
        $staffid = User::where('id','=',$id)->pluck('staff_id');

        Application::where('applicant_id', '=', $staffid)->update(['applicant_name' => request('name')]);        

        User::where('id', '=', $id)->update(['name' => request('name')]);
        session()->flash('useredited');
        return redirect()->back();
    }

    public function editemail($id)
    {
        if (User::where('email', '=', request('email'))->exists()) {
            session()->flash('dupuser');
            return redirect()->back();
        }

        $staffid = User::where('id','=',$id)->pluck('staff_id');

        Application::where('applicant_id', '=', $staffid)->update(['email' => request('email')]);        

        User::where('id', '=', $id)->update(['email' => request('email')]);
        session()->flash('useredited');
        return redirect()->back();
    }

    public function editpassword($id)
    {
        $pass = Hash::make(request('password'));
        User::where('id', '=', $id)->update(['password' => $pass]);
        session()->flash('useredited');
        return redirect()->back();
    }
}
