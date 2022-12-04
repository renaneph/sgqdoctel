<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minhas solicitações de Arquivos') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    <a href="/usuario/solicitacaoarquivos/adicionar" class="btn btn-info edit-btn"><i class="fa fa-plus fa-1x"></i> Adicionar</a>
    @if(count($arquivos_usuario) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome do Arquivo</th>
                <th scope="col">Versão do Arquivo</th>
                <th scope="col">Departamento</th>
                <th scope="col">Arquivo Original</th>
                <th scope="col">Arquivo PDF</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arquivos_usuario as $arquivo)
                    <tr>
                        <td>{{ $arquivo->nome_arquivo }}</td>
                        <td>{{ $arquivo->versao }}</td>
                        @foreach($departamentos as $departamento)
                            @if( $arquivo->departamento == $departamento->id)
                            <td>{{ $departamento->nome }}</td>
                            @endif
                        @endforeach
                        <td><a href="/arquivos_originais/{{ $arquivo->arquivo_original }}"><i class="fa fa-file fa-3x"></i></a></td>
                        <td><a href="/arquivos_pdf/{{ $arquivo->arquivo_pdf }}"><i class="fa fa-file-pdf fa-3x"></i></a></td>
                        <td>{{ $arquivo->data_criacao->format('d/m/Y')}} </td>
                        <td>{{ $arquivo->status }} </td>
                        <td>
                            <a href="/usuario/solicitacaoarquivos/editar/{{ $arquivo->id }}" class="btn btn-info edit-btn"><i class="fa fa-edit fa-1x"></i> Editar</a> 
                            <form action="/usuario/solicitacaoarquivos/deletar/{{ $arquivo->id }}" method="POST">
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
    <p>Não tem Solicitação de Arquivos cadastrados no sistema para este usuário !</p>
    @endif
    </div>
</x-app-layout>