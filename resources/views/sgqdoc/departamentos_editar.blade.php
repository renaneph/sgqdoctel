<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Departamento'. $departamento->nome) }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/departamentos/atualizar/{{ $departamento->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="departamento">Nome do Departamento:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Departamento" value="{{ $departamento->nome }}">
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Editar">
  </form>
    </div>
</x-app-layout>