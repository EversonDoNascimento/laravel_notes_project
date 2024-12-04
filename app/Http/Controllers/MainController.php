<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        // list of notes
        $user = \session('user');
        $notes = User::find($user['id'])->notes()->whereNull('deleted_at')->get()->toArray();
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

        if($idDecode == null){
            return \redirect()->route('home');
        }
        // Get note
        $note = Note::find($idDecode);
        return \view('edit', ['note' => $note]);
    }

    /**
     * Submits an edited note.
     * 
     * Validates the request with the following rules:
     * - The title must be required and not longer than 255 characters.
     * - The note must be required and not shorter than 5 characters.
     * 
     * Verifies if the note exists.
     * 
     * Updates the note with the validated data.
     * 
     * Redirects to the home route.
     * 
     * @param Request $request
     * @return Response
     */
    public function editSubmit(Request $request){
        // Validate request
        $request->validate([
            'id' => 'required',
            'text_title' => 'required|max:255',
            'text_note' => 'required|min:5',
        ],[
            'id.required' => 'Id is required',
            'text_title.required' => 'Title is required',
            'text_title.max' => 'Title is too long',
            'text_note.required' => 'Note is required',
            'text_note.min' => 'Note is too short'
        ]);
        $idDecode = Operations::decryptId($request->id);
        if($idDecode == null){
            return \redirect()->route('home');
        }
        // Verify if note exists
        $findNote = Note::find($idDecode);
        if(!$findNote){
            return \redirect()->route('home');
        }
        // Update note
        $findNote->update([
            'title' => $request->text_title,
            'text' => $request->text_note
        ]);
        return \redirect()->route('home');
    }

    public function delete($id){
        $idDecode = Operations::decryptId($id);
        if($idDecode == null){
            return \redirect()->route('home');
        }
        if(!$idDecode){
            return \redirect()->route('home');
        }
        // Get note
        $note = Note::find($idDecode);
        if(!$note){
            return \redirect()->route('home');
        }
        return view("noteDelete", ['note' => $note]);
    }

    public function deleteSubmit($id){
        $idDecode = Operations::decryptId($id);
        if($idDecode == null){
            return \redirect()->route('home');
        }
        if(!$idDecode){
            return \redirect()->route('home');
        }
        // Get note
        $note = Note::find($idDecode);
        if(!$note){
            return \redirect()->route('home');
        }
        // Delete note
        $note->delete();
        return \redirect()->route('home');
    }

    /**
     * Submits a new note.
     * 
     * Validates the request with the following rules:
     * - The title must be required and not longer than 255 characters.
     * - The note must be required and not shorter than 5 characters.
     * 
     * Gets the user id from the session.
     * 
     * Creates a new Note with the validated data.
     * 
     * Redirects to the home route.
     * 
     * @param Request $request
     * @return Response
     */
    public function newNoteSubmit(Request $request){
        // Validate request
        $request->validate([
            'text_title' => 'required|max:255',
            'text_note' => 'required|min:5'
        ],[
            'text_title.required' => 'Title is required',
            'text_title.max' => 'Title is too long',
            'text_note.required' => 'Note is required',
            'text_note.min' => 'Note is too short'
        ]);
        // Get user id
        $user = \session('user');
        $user_id = $user['id'];
        // Create new note
        $createNote = Note::create([
            'user_id' => $user_id,
            'title' => $request->text_title,
            'text' => $request->text_note
        ]);
        // redirect to home
        return \redirect()->to('/');
        // dd($request);
        // die();
        // return \redirect()->route('newNote');
    }
    

}
