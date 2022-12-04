<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Departamentos') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    <a href="/admin/departamentos/adicionar" class="btn btn-info edit-btn"><i class="fa fa-plus fa-1x"></i> Adicionar</a>
    <a href="/admin/departamentos/exportarexcel" class="btn btn-success edit-btn"><i class="fa fa-file-excel fa-1x"></i> Excel</a>
    <a href="/admin/departamentos/exportarpdf" class="btn btn-danger edit-btn"><i class="fa fa-file-pdf fa-1x"></i> PDF</a>
    @if(count($departamentos) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departamentos as $departamento)
                    <tr>
                        <td>{{ $departamento->nome }}</td>
                        <td>{{ $departamento->data_criacao->format('d/m/Y')}} </td>
                        <td>
                        <a href="/admin/departamentos/editar/{{ $departamento->id }}" class="btn btn-info edit-btn"><i class="fa fa-edit fa-1x"></i> Editar</a> 
                        <form action="/admin/departamentos/deletar/{{ $departamento->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><i class="fa fa-trash fa-1x"></i> Deletar</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <br/>
    <br/>
    <p>Não tem Departamentos cadastrados no sistema !</p>
    @endif
    </div>
</x-app-layout>