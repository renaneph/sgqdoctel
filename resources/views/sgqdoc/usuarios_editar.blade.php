<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário'. $usuario->name) }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-6 offset-md-1 dashboard-events-container">
    <form action="/admin/usuarios/atualizar/{{ $usuario->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="usuario">Nome de Usuário:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome de Usuário" value="{{ $usuario->name }}">
    </div>
    <br/>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $usuario->email }}">
    </div>
    <br/>
    <div class="form-group">
      <label for="perfil">Perfil:</label>
      <select name="perfil" id="perfil" class="form-control">
        <option value="Colaborador">Colaborador</option>
        <option value="Administrador">Administrador</option>
      </select>
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Editar">
  </form>
    </div>
</x-app-layout>