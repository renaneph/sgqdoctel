<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Arquivo'. $arquivo->nome) }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/arquivos/atualizar/{{ $arquivo->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nome">Nome do Arquivo:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Arquivo" value="{{ $arquivo->nome_arquivo }}">
    </div>
    <br/>
    <div class="form-group">
      <label for="versao">Versão do Arquivo:</label>
      <input type="text" class="form-control" id="versao" name="versao" placeholder="Versão do Departamento" value="{{ $arquivo->versao }}">
    </div>
    <br/>
    <div class="form-group">
      <label for="departamento">Departamento:</label>
      <select name="departamento" id="departamento" class="form-control">
        @foreach($departamentos as $departamento)
        <option value="{{ $departamento->id }}" {{ $arquivo->departamento == $departamento->id ? "selected='selected'" : "" }}>{{ $departamento->nome }}</option>
        @endforeach
      </select>
    </div>
    <br/>
    <div class="form-group">
      <label for="arquivo_orig">Arquivo Original:</label>
      <input type="file" class="form-control" id="arquivo_orig" name="arquivo_orig" placeholder="Arquivo Original" value="{{ $arquivo->arquivo_original }}">
    </div>
    <br/>
    <div class="form-group">
      <label for="arquivo_pdf">Arquivo PDF:</label>
      <input type="file" class="form-control" id="arquivo_pdf" name="arquivo_pdf" placeholder="Arquivo PDF" value="{{ $arquivo->arquivo_pdf }}">
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Editar">
  </form>
    </div>
</x-app-layout>