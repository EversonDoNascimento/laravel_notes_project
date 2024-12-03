<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
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

    public function newNote(Request $request){
        return \view('newNote');
    }
    public function edit($id){
        $idDecode = Operations::decryptId($id);
        return \view('edit', ['id' => $idDecode]);
    }

    public function delete($id){
        $idDecode = Operations::decryptId($id);
        echo $idDecode;
    }
    public function newNoteSubmit(Request $request){
        dd($request);
        die();
        return \redirect()->route('newNote');
    }
    

}
