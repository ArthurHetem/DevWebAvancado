@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa }}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="form-group row">
                            <label for="data_limite" class="col-md-4 col-form-label text-md-right">Data limite conclusão</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" value="{{ $tarefa->data_limite }}">
                            </div>
                        </div>
                    </fieldset>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
