<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user,StoreCommentsRequest $request){
//        dd('done');
          $user->commentOn()->create([
            'content'=>$request->input('content'),
            'user_id'=>$request->user()->id
        ]);

//         $request->session()::flash('status','Comment was Created With By User !');

        return redirect()->back()->withStatus('Commented has been created!');
    }
    //
}
