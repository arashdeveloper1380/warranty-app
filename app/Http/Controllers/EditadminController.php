<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditadminController extends Controller
{
    public function edit(int $id){
        $admin = User::find($id);

        return view('edit-admin', compact('admin'));
    }

    public function update(Request $request, int $id){
        $admin = User::find($id);

        if($request->permission != $admin->permission){
            $admin->update(['permission', null]);

            $admin->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'permission'    => $request->permission
            ]);

        }else{
            $admin->update([
                'name'          => $request->name,
                'email'         => $request->email,
            ]);
        }

        return redirect('dashboard/admin')->with('success', 'کاربر با موفقیت ویرایش شد');

    }
}
