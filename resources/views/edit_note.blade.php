@extends('layouts.main_layout')


@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">Editar Nota</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>            
                </div>
            </div>

            <!-- form -->
            <form action="{{ route('editNoteSubmit') }}" method="post">
                @csrf
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control bg-primary text-white @error('text_title') is-invalid @enderror" name="text_title" value="{{ old('text_title', $note->title) }}">
                            @error('text_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Texto</label>
                            <textarea class="form-control bg-primary text-white @error('text_note') is-invalid @enderror" name="text_note" rows="5">{{ old('text_note', $note->text) }}</textarea>
                            @error('text_note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Salvar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection