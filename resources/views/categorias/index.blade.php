@extends('layouts.app')

@section('titulo','Categorias')
@section('conteudo')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Nova Categoria
    </a>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Categoria Pai</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($categorias as $categoria)
        <tr>
          <td>{{ $categoria->id }}</td>
          <td>{{ $categoria->nome }}</td>
          <td>{{ $categoria->parent->nome ?? '-' }}</td>
          <td class="d-flex gap-1">
            <a href="{{ route('categorias.show',$categoria) }}" class="btn btn-sm btn-primary">Ver</a>
            <a href="{{ route('categorias.edit',$categoria) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('categorias.destroy',$categoria) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta categoria?')">Excluir</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">Sem categorias cadastradas.</td></tr>
      @endforelse
    </tbody>
  </table>
@endsection