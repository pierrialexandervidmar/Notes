<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index() {
    echo 'Página interna do sistema, home';
  }

  public function newNote() {
    echo 'Formulário para criação de uma nova nota';
  }
}

