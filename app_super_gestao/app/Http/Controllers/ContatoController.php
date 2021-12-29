<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use PhpParser\Node\Expr\FuncCall;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        /*$contato = new SiteContato();

        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('nmotivo_contato');
        $contato->mensagem = $request->input('mensagem');

        $contato->save();*/

        //$contato = new SiteContato();

        /*$contato->fill($request->all());

        $contato->save();*/

        //$contato->create($request->all());

        $motivos_contato = MotivoContato::all();


        return view('site.contato', ['title' => 'Contato', 'motivos_contato' => $motivos_contato]);
    }

    public function salvar(Request $request) {
        $request->validate(
                [
                    'nome' => 'required|min:3|max:40',
                    'telefone' => 'required',
                    'email' => 'email',
                    'motivos_contato_id' => 'required',
                    'mensagem' => 'required|max:2000',
                ],
                [
                    'nome.required' => 'O campo nome é obrigatório',
                    'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                    'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                    'telefone.required' => 'O campo telefone é obrigatório',
                    'email.email' => 'O campo email deve ser um email válido',
                    'motivos_contato_id.required' => 'O campo motivo de contato é obrigatório',
                    'mensagem.required' => 'O campo mensagem é obrigatório',
                    'mensagem.max' => 'O campo mensagem deve ter no máximo 2000 caracteres',
                ]
     );
        SiteContato::create($request->all());
        return redirect()->route('site.index')->with('success', 'Mensagem enviada com sucesso!');
    }
}
