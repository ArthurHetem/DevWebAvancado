@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <label for="tarefa" class="col-md-4 col-form-label text-md-right">Tarefa</label>

                            <div class="col-md-6">
                                <input id="tarefa" type="text" class="form-control @error('tarefa') is-invalid @enderror" name="tarefa" value="{{ $tarefa->tarefa ?? old('tarefa') }}" required autocomplete="tarefa" autofocus>

                                @error('tarefa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_limite" class="col-md-4 col-form-label text-md-right">Data limite conclusão</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="data_limite" value="{{ $tarefa->data_limite ?? old('data_limite') }}">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
