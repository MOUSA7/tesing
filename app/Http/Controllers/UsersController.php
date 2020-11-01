<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Image;
use App\Services\Counter;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    private $counter;

    public function __construct(Counter $counter)
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class,'user');
        $this->counter = $counter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        $counter = resolve(Counter::class);
//        dd('done');
        return view('users.show',['user'=>$user,'counter'=>$this->counter->increment("user-{$user->id}")]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',['user'=>$user]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       if ($request->hasFile('avatar')){
           $path = $request->file('avatar')->store('avatars');

           if ($user->image){
               $user->image->path = $path;
               $user->image->save();
           }else{
//               $image = new Image();
//               $image->path = $path;
               $user->image()->save(
                 Image::make(['path'=>$path])
               );
           }
       }
       $user->locale = $request->get('locale');
       $user->save();
//       dd($user);
       return redirect()->back()->withStatus('Profile Image was Updated!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
