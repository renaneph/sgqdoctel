<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitações de Arquivos para Aprovação') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
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
                        <td>
                            <a href="/admin/aprovacaoarquivos/aprovarsolicitacao/{{ $arquivo->id }}" class="btn btn-success edit-btn"><ion-icon name="create-outline"></ion-icon> Aprovar</a>
                            <a href="/admin/aprovacaoarquivos/recusarsolicitacao/{{ $arquivo->id }}" class="btn btn-danger edit-btn"><ion-icon name="create-outline"></ion-icon> Recusar</a> 
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