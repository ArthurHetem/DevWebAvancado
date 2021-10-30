<h3>Fornecedor</h3>

@php
  /*
  if( !<condicao>) {

  }
  */
@endphp
{{-- @unless execute se o retorno for falso --}}

Fornecedor: {{ $fornecedores[0]['nome'] }}
<br />
Status: {{ $fornecedores[0]['status'] }}
@if( !($fornecedores[0]['status'] == 'N') )
  Fornecedor inativo
@endif
<br />
@unless($fornecedores[0]['status'] == 'S')
  Fornecedor inativo
@endunless