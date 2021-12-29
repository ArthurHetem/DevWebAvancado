{{ $slot }}
<form action={{ route('site.contato') }} method="POST">
  @csrf
  <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
    @if($errors->has('nome'))
    <span class="erro">{{ $errors->first('nome') }}</span>
    @endif
  <br>
  <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="borda-preta">
    @if($errors->has('telefone'))
    <span class="erro">{{ $errors->first('telefone') }}</span>
    @endif
  <br>
  <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="borda-preta">
    @if($errors->has('email'))
    <span class="erro">{{ $errors->first('email') }}</span>
    @endif
  <br>
    <select name="motivos_contato_id" class="borda-preta">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivos_contato as $motivo)
            <option value="{{ $motivo->id }}" {{ old('motivos_contato_id') == $motivo->id ? 'selected' : '' }}>{{ $motivo->motivo_contato }}</option>
        @endforeach
  </select>
    @if($errors->has('motivos_contato_id'))
    <span class="erro">{{ $errors->first('motivos_contato_id') }}</span>
    @endif
  <br>
  <textarea name="mensagem" class="borda-preta">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    @if($errors->has('mensagem'))
        <span class="erro">{{ $errors->first('mensagem') }}</span>
    @endif
  <br>
  <button type="submit" class="borda-preta">ENVIAR</button>
</form>
