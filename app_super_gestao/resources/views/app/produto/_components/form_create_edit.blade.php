@if(isset($produto->id))
    <form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="post">
        @method('PUT')
        @csrf
@else
    <form action="{{ route('produto.store') }}" method="post">
        @csrf
@endif
        {{-- <input type="hidden" name="id" value="$fornecedor->id ?? ''"> --}}
        <input type="text" name="nome" placeholder="Nome" class="borda-preta" value="{{ $produto->nome ?? old('nome') }}">
        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
        <input type="text" name="descricao" placeholder="Descrição" class="borda-preta" value="{{ $produto->descricao ?? old('descricao') }}">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
        <input type="text" name="peso" placeholder="Peso" class="borda-preta" value="{{ $produto->peso ?? old('peso') }}">
        {{ $errors->has('peso') ? $errors->first('') : '' }}
        <select name="unidade_id" >
            <option>-- Selecione a unidade --</option>
            @foreach($unidades as $unidade)
                <option value="{{ $unidade->id }}" {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
            @endforeach
        </select>
        <button type="submit" class="borda-preta">Cadastrar</button>
    </form>
