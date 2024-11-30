<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        // list of notes
        $user = \session('user');
        $notes = User::find($user['id'])->notes()->get()->toArray();
        // echo "<pre>";
        // print_r($user);
        // print_r($notes);
        // die();
        // show notes
        return view('home', ['notes' => $notes]);
    }

    public function newNote(){
        echo "new note";
    }
}
