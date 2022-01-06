@extends('app.layouts.basico')

@section('titulo', 'Fornecedor - Listar')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacoes-pagina">
            <table border="1" style="width: 100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>UF</th>
                        <th>Site</th>
                        <th>E-mail</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->nome }}</td>
                            <td>{{ $fornecedor->uf }}</td>
                            <td>{{ $fornecedor->site }}</td>
                            <td>{{ $fornecedor->email }}</td>
                            <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $fornecedores->appends($request)->links('pagination::bootstrap-4') }}
        <br>
        {{ $fornecedores->count() }} - Total de registros por página.
        <br>
        {{ $fornecedores->total() }} - Total de registros.
        <br>
        {{ $fornecedores->firstItem() }} - Número do primeiro registro.
        <br>
        {{ $fornecedores->lastItem() }} - Número do último registro.
    </div>

@endsection
