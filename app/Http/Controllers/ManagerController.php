<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request\ManagerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    //
   
    public function index(){
        $managers = User::where('is_admin', True)->orderBy('id','desc')->paginate(10);
        return view('admin.managers.index')->with('managers', $managers);
    }

    public function Create(){
        return view('admin.managers.create');
    }

    public function store(Request $request){
        $form_data = $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $manager = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "is_admin" => 1,
            "password" => Hash::make($request->password),
            
        ]);

        if(!$manager){
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while creating manager.');
        }
        return redirect('Manager')->with('success', 'Success, your manager have been created.');
    }
    
    public function edit($id){
        $manager = User::where('is_admin', True)->findOrFail($id);
        return view('admin.managers.edit', compact('manager'));
    }

    public function update(Request $request, $id){
        $form_data = $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);


        $manager = User::find($id);
        $manager->first_name = $request->first_name;
        $manager->last_name = $request->last_name;
        $manager->email = $request->email;
        $manager->password = Hash::make($request->password);
        $manager->update();
        if(!$manager){
            return redirect()->back()-with('error', 'Sorry, there\'re a problem while update manager.');
        }
        return redirect('Manager')->with('success', 'Success, manager has been updated.');
    }
    public function destroy($id){
        $manager = User::where('is_admin', True)->findOrFail($id);
        $manager->delete();
        return back->with('success', 'Success, manager has been deleted' );
    }



}
