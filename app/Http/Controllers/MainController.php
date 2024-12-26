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

        if (!$user)
        {
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
            'text_title' => 'required|max:200',
            'text_note' => 'required|max:3000'
        ]);

        $title = $request->input('text_title');
        $text = $request->input('text_note');

        $user = User::find(session('user.id'));
        $user->notes()->create(['title' => $title, 'text' => $text]);

        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);

        if ($id === null)
        {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {

        $request->validate([
            'text_title' => 'required|max:200',
            'text_note' => 'required|max:3000'
        ]);

        if ($request->note_id == null)
        {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);

        if ($id === null)
        {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        if (!$note)
        {
            return redirect()->route('home')->with('error', 'Nota não encontrada.');
        }

        $note->title = $request->input('text_title');
        $note->text = $request->input('text_note');
        $note->save();

        return redirect()->route('home');
    }

    public function deleteNoteConfirm($id)
    {
        $id = Operations::decryptId($id);

        if ($id === null)
        {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        if ($id === null)
        {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        if (!$note)
        {
            return redirect()->route('home')->with('error', 'Nota não encontrada.');
        }

        // hard delete
        //$note->delete();

        // soft delete
        //$note->deleted_at = date('Y:m:d H:i:s');
        //$note->save();

        // soft delete por model, agora com a propriedade setada lá.
        $note->delete();

        // se quiser forçar a exclusão mesmo tendo o soft delete setado no model
        //$note->forceDelete();

        return redirect()->route('home');
    }
}
