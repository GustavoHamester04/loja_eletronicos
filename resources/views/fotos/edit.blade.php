@extends('layouts.app')

@section('titulo', 'Editar Foto')
@section('conteudo')
    <h1>Editar Foto</h1>
    <form action="{{ route('fotos.update', $foto) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select name="produto_id" id="produto_id" class="form-select @error('produto_id') is-invalid @enderror">
                @foreach($produtos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('produto_id', $foto->produto_id) == $id)>{{ $nome }}</option>
                @endforeach
            </select>
            @error('produto_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="arquivo" class="form-label">Foto Atual</label>
            <div><img src="{{ asset('storage/' . $foto->arquivo) }}" alt="Foto" width="150"></div>
        </div>
        <div class="mb-3">
            <label for="arquivo" class="form-label">Nova Foto (opcional)</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control @error('arquivo') is-invalid @enderror">
            @error('arquivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning w-100">Atualizar</button>
            <a href="{{ route('fotos.index') }}" class="btn btn-secondary w-100">Cancelar</a>
        </div>
    </form>
@endsection