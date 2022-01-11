@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            Listagem de Tarefas
                        </div>
                        <div class="col-1">
                            <a href="{{ route('tarefa.exportacao', ['extensao' => 'xlsx']) }}">XLSX</a>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('tarefa.exportacao', ['extensao' => 'csv']) }}">CSV</a></div>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('tarefa.exportacao', ['extensao' => 'pdf']) }}">PDF</a></div>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('tarefa.create') }}">Novo</a></div>
                        </div>
                    </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data limite</th>
                                <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{ $tarefa->id }}</th>
                                    <th>{{ $tarefa->tarefa }}</th>
                                    <th>{{ date('d/m/y', strtotime($tarefa->data_limite)) }}</th>
                                    <th><a href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id]) }}">Editar</a></th>
                                    <th>
                                        <form id="form_{{ $tarefa->id }}" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" onclick="document.getElementById('form_{{ $tarefa->id }}').submit();">Excluir</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{  $tarefas->appends($request)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
