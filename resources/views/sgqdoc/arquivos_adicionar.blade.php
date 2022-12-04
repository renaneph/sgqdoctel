<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Arquivo') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/arquivos/adicionararquivo" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="nome">Nome do Arquivo:</label>
      <input type="text" class="form-control" id="nome" name="nome">
    </div>
    <br/>
    <div class="form-group">
      <label for="versao">Versão do Arquivo:</label>
      <input type="text" class="form-control" id="versao" name="versao">
    </div>
    <br/>
    <div class="form-group">
      <label for="departamento">Departamento:</label>
      <select name="departamento" id="departamento" class="form-control">
        <option value="0"></option>
        @foreach($departamentos as $departamento)
        <option value="{{ $departamento->id }}">{{ $departamento->nome }}</option>
        @endforeach
      </select>
    </div>
    <br/>
    <div class="form-group">
      <label for="arquivo_orig">Arquivo Original:</label>
      <input type="file" class="form-control" id="arquivo_orig" name="arquivo_orig">
    </div>
    <br/>
    <div class="form-group">
      <label for="arquivo_pdf">Arquivo PDF (Caso seja um Documento):</label>
      <input type="file" class="form-control" id="arquivo_pdf" name="arquivo_pdf">
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Adicionar">
  </form>
    </div>
</x-app-layout>