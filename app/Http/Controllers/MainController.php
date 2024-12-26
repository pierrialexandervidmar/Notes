<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Sessão inválida. Faça login novamente.');
        }

        $notes = $user->notes()->orderBy('created_at', 'desc')->get()->toArray();

        // show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        $id = session('user.id');
        $user = User::find($id)->toArray();

        return view('new_note', ['user' => $user]);
    }

    public function submitNote(Request $request)
    {
        $request->validate([
            'text_title' =>'required|max:200',
            'text_note' =>'required|max:3000'
        ]);

        $title = $request->input('text_title');
        $text = $request->input('text_note');

        $user = User::find(session('user.id'));
        $user->notes()->create(['title' => $title, 'text' => $text]);        

        return redirect()->route('home');
    }

    public function editNode($id)
    {
        $id = Operations::decryptId($id);
        $note = Note::find($id);

        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit($id)
    {
        $id = Operations::decryptId($id);
        $note = Note::find($id);

        return view('edit_note', ['note' => $note]);
    }

    public function deleteNode($id)
    {
        $id = Operations::decryptId($id);
        $note = User::find(session('user.id'))->notes()->find($id)->toArray();

        echo 'Confirmação para excluir a nota '. $note['title'];
    }
}
