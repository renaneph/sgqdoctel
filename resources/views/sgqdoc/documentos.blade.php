<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Documentos') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($arquivos) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome do Arquivo</th>
                <th scope="col">Versão do Arquivo</th>
                <th scope="col">Departamento</th>
                <th scope="col">Arquivo</th>
                <th scope="col">Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arquivos as $arquivo)
                    <tr>
                        <td>{{ $arquivo->nome_arquivo }}</td>
                        <td>{{ $arquivo->versao }}</td>
                        @foreach($departamentos as $departamento)
                            @if( $arquivo->departamento == $departamento->id)
                            <td>{{ $departamento->nome }}</td>
                            @endif
                        @endforeach
                        <form action="/documentos/visualizar/{{ $arquivo->id }}" method="GET">
                            @csrf
                            <td><a href="/arquivos_pdf/{{ $arquivo->arquivo_pdf }}" style="text-decoration:none;"><button type="submit" class="btn btn-second"><i class="fa fa-file-pdf fa-2x"></i> Visualizar</button></a></td>
                        </form>
                        <td>{{ $arquivo->data_criacao->format('d/m/Y')}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <br/>
    <br/>
    <p>Não tem Documentos cadastrados no sistema !</p>
    @endif
    </div>
</x-app-layout>