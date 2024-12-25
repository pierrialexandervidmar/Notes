<?php

namespace App\Http\Controllers;

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
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->orderBy('created_at', 'desc')->get()->toArray();

        // show home view
        return view('home', ['notes' => $notes, 'user' => $user]);
    }

    public function newNote()
    {
        $id = session('user.id');
        $user = User::find($id)->toArray();

        return view('new_note', ['user' => $user]);
    }

    public function submitNote(Request $request)
    {
        echo 'Submetida nova nota';
    }

    public function editNode($id)
    {
        $id = Operations::decryptId($id);
        $note = User::find(session('user.id'))->notes()->find($id)->toArray();

        echo 'Formulário para edição da nota '. $note['title'];
    }

    public function deleteNode($id)
    {
 
        $id = Operations::decryptId($id);
        $note = User::find(session('user.id'))->notes()->find($id)->toArray();

        echo 'Confirmação para excluir a nota '. $note['title'];
    }
}
