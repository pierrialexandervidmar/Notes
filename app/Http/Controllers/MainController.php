<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index() 
  {
    // Load Users Notes

    // show home view
    return view('home');
  }

  public function newNote() 
  {
    echo 'Formulário para criação de uma nova nota';
  }
}

