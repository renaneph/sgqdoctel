<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aprovar Solicitação Arquivo'. $arquivo_usuario->nome_arquivo) }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/aprovacaoarquivos/aprovarsolicitacao/aprovar/{{ $arquivo_usuario->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="comentario_administrador">Comentário do Administrador:</label>
      <input type="text" class="form-control" id="comentario_administrador" name="comentario_administrador">
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Aprovar">
  </form>
    </div>
</x-app-layout>