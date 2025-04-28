<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $total = array_sum(array_map(function ($item) {
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
    public function finalizar(Request $request)
    {
        $request->validate([
            'endereco_id' => 'required|exists:enderecos,id',
        ]);

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        $venda = \App\Models\Venda::create([
            'cliente_id' => Auth::id(),
            'endereco_id' => $request->endereco_id,
            'valor_total' => 0,
        ]);

        $total = 0;
        foreach ($carrinho as $id => $item) {
            $produto = \App\Models\Produto::findOrFail($id);
            $subtotal = $item['subtotal'];

            $venda->produtos()->attach($produto->id, [
                'quantidade' => $item['quantidade'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $venda->update(['valor_total' => $total]);

        session()->forget('carrinho'); // Limpa carrinho

        return redirect()->route('vendas.index')->with('success', 'Compra finalizada com sucesso!');
    }

}
