@extends('layouts.app')

@section('titulo', 'Nova Foto de Produto')
@section('conteudo')
    <h1>Nova Foto</h1>
    <form action="{{ route('fotos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select name="produto_id" id="produto_id" class="form-select @error('produto_id') is-invalid @enderror">
                <option value="">Selecione</option>
                @foreach($produtos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('produto_id') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
            @error('produto_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="arquivo" class="form-label">Foto</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control @error('arquivo') is-invalid @enderror">
            @error('arquivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
            <a href="{{ route('fotos.index') }}" class="btn btn-secondary w-100">Cancelar</a>
        </div>
    </form>
@endsection