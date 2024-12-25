<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        // Load Users Notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->orderBy('created_at', 'desc')->get()->toArray();

        // show home view
        return view('home', ['notes' => $notes, 'user' => $user]);
    }

    public function newNote()
    {
        echo 'Formulário para criação de uma nova nota';
    }

    public function editNode($id)
    {
        $id = Crypt::decrypt($id);
        $note = User::find(session('user.id'))->notes()->find($id)->toArray();

        print_r($id);
    }
}
