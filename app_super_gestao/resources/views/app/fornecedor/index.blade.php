<h3>Fornecedor</h3>

@php
    /*
    if(empty($variavel)) {} //retornar true se a variável estiver vazia
    - ''
    - 0
    - 0.0
    - '0'
    - null
    - false
    - array()
    - $var
    */
@endphp

@isset($fornecedores)
    @forelse($fornecedores as $indice => $fornecedor)
        Iteração atual: {{ $loop->iteration }}
        <br>
        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{  $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}
        <br>
        Telefone {{  $fornecedor['ddd'] ?? '' }} {{ $fornecedor['telefone'] ?? '' }}
        @if ($loop->first)
            Primeira iteração do loop
        @endif
        @if ($loop->last)
            Última iteração do loop
            <br>
            Total de registros: {{ $loop->count }}
    @empty
        Não existem fornecedores cadastrados!!!
    @endforelse
@endisset
