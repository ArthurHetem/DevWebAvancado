<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Tarefa::all();
        return auth()->user()->tarefas->get();
    }

    public function headings() : array
    {
        return [
            'ID Tarefa',
            'ID Usuário',
            'Tarefa',
            'Data limite conclusao',
            'Data criacao',
            'Data atualizacao'
        ];
    }

    public function map($linha) : array
    {
        return [
            $linha->id,
            $linha->user_id,
            $linha->tarefa,
            date(strtotime('d/m/y', $linha->data_limite_conclusao)),
            date(strtotime('d/m/y', $linha->created_at)),
            date(strtotime('d/m/y', $linha->updated_at))
        ];
    }
}
