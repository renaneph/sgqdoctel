<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot>
<br/>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($usuarios) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Perfil</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->perfil }}</td>
                        <td>
                        <a href="/admin/usuarios/editar/{{ $usuario->id }}" class="btn btn-info edit-btn"><i class="fa fa-edit fa-1x"></i> Editar</a> 
                        <form action="/admin/usuarios/deletar/{{ $usuario->id }}" method="POST">
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
    <p>Não tem usuários cadastrados no sistema !</p>
    @endif
    </div>
</x-app-layout>