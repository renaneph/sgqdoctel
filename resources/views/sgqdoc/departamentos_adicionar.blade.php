<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Departamento') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/departamentos/adicionardepartamento" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="usuario">Nome do Departamento:</label>
      <input type="text" class="form-control" id="nome" name="nome">
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Adicionar">
  </form>
    </div>
</x-app-layout>