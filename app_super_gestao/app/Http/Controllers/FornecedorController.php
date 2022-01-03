<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(1);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {
        if($request->input('_token') != null && $request->input('id') == null) {
            $regras = [
                'nome' => 'required|min:3|max:40',
                'email' => 'required|email|unique:fornecedores',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
                'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
                'email' => 'O campo :attribute deve ser um e-mail válido.',
                'unique' => 'O campo :attribute já está cadastrado.',
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();

            $fornecedor->create($request->all());
        }

        if ($request->input('_token') != null && $request->input('id') != null) {
            $fornecedor = Fornecedor::find($request->input('id'));
            $fornecedor->update($request->all());

            return redirect()->route('app.fornecedor.editar'. ['id' => $request->input('id')]);
        }
        return view('app.fornecedor.adicionar');
    }

    public function editar($id){
        $fornecedor = Fornecedor::find($id);

        return(view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor]));
    }
}
