@extends('layouts.app')

@section('titulo', 'Carrinho')

@section('conteudo')
    <h1>Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($carrinho))
        <p class="text-center">Seu carrinho está vazio.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrinho as $id => $item)
                    <tr>
                        <td>{{ $item['nome'] }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['valor'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: R$ {{ number_format($total, 2, ',', '.') }}</h4>

        <form action="{{ route('carrinho.limpar') }}" method="POST">
            @csrf
            <button class="btn btn-warning">Limpar Carrinho</button>
        </form>
    @endif
@endsection