<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::where('user_type','admin')->orderBy('id','desc')->get();
        return view('backend.pages.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users,email',
        ]);
        //generate password
        $code = rand(0000,9999);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->user_type = 'admin';
        $user->password = Hash::make($code);
        $user->code = $code;
        $user->save();
        return redirect()->route('user.index')->with('success','user  has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::find($id);
        return view('backend.pages.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable',
            'email' =>'nullable',
        ]);

        $user = User::find($id);
        if (!is_null($request->name)) {
            $user->name = $request->name;
        }else{
            return back()->with('error','Please, Input user Name');
        }
        if (!is_null($request->email)) {
            $user->email = $request->email;
        }else{
            return back()->with('error','Please, Input user Email');
        }
        $user->role = $request->role;
        
        $user->save();
        return redirect()->route('user.index')->with('success','user  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }else{
            return redirect()->route('user.index')->with('error','There is no user name by this ID , SORRY');
        }

        return back()->with('success','Your user has been deleted successfully');
    }
}
