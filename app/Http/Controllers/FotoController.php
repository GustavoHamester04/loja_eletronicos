<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Produto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with('produto')->paginate(10);
        return view('fotos.index', compact('fotos'));
    }

    public function create()
    {
        $produtos = Produto::pluck('nome', 'id');
        return view('fotos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|image|max:2048',
            'produto_id' => 'required|exists:produtos,id',
        ]);

        // verifica limite de 5 fotos
        if (Foto::where('produto_id', $request->produto_id)->count() >= 5) {
            return back()->withErrors('Máximo de 5 fotos por produto.');
        }

        // faz upload
        $path = $request->file('arquivo')->store('produtos', 'public');

        Foto::create([
            'arquivo' => $path,
            'produto_id' => $request->produto_id,
        ]);

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Foto enviada com sucesso!');
    }

    public function show(Foto $foto)
    {
        return view('fotos.show', compact('foto'));
    }

    public function edit(Foto $foto)
    {
        $produtos = Produto::pluck('nome', 'id');
        return view('fotos.edit', compact('foto', 'produtos'));
    }

    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'arquivo' => 'nullable|image|max:2048',
            'produto_id' => 'required|exists:produtos,id',
        ]);

        if ($request->hasFile('arquivo')) {
            // opcional: apagar arquivo antigo
            \Storage::disk('public')->delete($foto->arquivo);
            $foto->arquivo = $request->file('arquivo')->store('produtos', 'public');
        }

        $foto->produto_id = $request->produto_id;
        $foto->save();

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Foto atualizada!');
    }

    public function destroy(Foto $foto)
    {
        // apaga do storage
        \Storage::disk('public')->delete($foto->arquivo);
        $foto->delete();

        return redirect()
            ->route('fotos.index')
            ->with('success', 'Foto excluída.');
    }
}
