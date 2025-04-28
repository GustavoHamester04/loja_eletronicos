<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $total = array_sum(array_map(function($item){
            return $item['subtotal'];
        }, $carrinho));

        return view('carrinho.index', compact('carrinho', 'total'));
    }

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
            $carrinho[$id]['subtotal'] = $carrinho[$id]['quantidade'] * $produto->valor;
        } else {
            $carrinho[$id] = [
                'nome' => $produto->nome,
                'valor' => $produto->valor,
                'quantidade' => 1,
                'subtotal' => $produto->valor,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index')->with('success', 'Produto removido!');
    }

    public function limpar()
    {
        session()->forget('carrinho');

        return redirect()->route('carrinho.index')->with('success', 'Carrinho limpo!');
    }
}
