<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return user::all();
    }

    public function user(Request $request)
    {
        return $request->user();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $request->password = Hash::make($request->password);
        $arr = array();
       $email = DB::select("SELECT COUNT(id) AS femail FROM users WHERE email =  '$request->email'");
       $user_name = DB::select("SELECT COUNT(id) AS uname FROM users WHERE user_name =  '$request->user_name'");

       if ($email[0]->femail > 0 || $user_name[0]->uname > 0) {
           $res = [ "email" => $email[0]->femail, "user" => $user_name[0]->uname];
           return $res;

       }else{
        user::create([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "image" => 'http://localhost:8000/storage/images/users/none.png',
            "user_name" => $request->user_name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return ["mensaje" => 'user created successfully!'];

       }

       

        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateImage(Request $request){
        if ($request->hasFile('image')) {
            $destination = 'public/images/users';
            $image = $request->file('image');
            $imageName =  $request->name . '.png';
            $path = $request->file('image')->storeAs($destination, $imageName);
            $urlImage = 'http://localhost:8000/storage/images/users/' . $imageName;

            DB::update("UPDATE `users` SET `image` = '$urlImage' WHERE `users`.`id` =  $request->id");

            return 'image save';
        }else{
            return 'image not save';
        }
    }
}
