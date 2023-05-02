@extends('layouts.app')

@section('content')
<main>

<div class="projects-list">

    <div class="container">

        @if($trashed = true)
        <h1>Tutti i progetti eliminati</h1>
        @else
        <h1>Tutti i progetti</h1>
        @endif


        <table class="table main-table">
            <thead>
                <tr>          
                    <th scope="col">Titolo</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Descrizione</th>               
                    <th scope="col">Nome Cliente</th>
                    <th scope="col">Telefono Cliente</th>
                    <th scope="col">Creato</th>
                    <th scope="col">Aggiornato</th>
                    <th scope="col">Eliminato</th>
                    <th scope="col">Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach($projects as $project)
                <tr>
                    <td>
                        {{ $project->title }} <br>
                        <a href="{{ route('projects.show', $project['slug']) }}">Vai al progetto</a>
                    </td>

                    {{-- laravel ci permette di utilizare il metodo definito nel model come se fosse un attributo --}}
                    <td>{{ $project->type ? $project->type->name : '-'}}</td>

                    <td>
                        @forelse ($project->technologies as $technology)
                            <span>{{ $technology->name }}</span>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>{{ $project->description }}</td>                     
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->client_tel }}</td>
                    <td>{{ $project->created_at->format('d/m/Y') }}</td>
                    <td>{{ $project->updated_at->format('d/m/Y') }}</td>
                    <td>{{ $project->trashed() ? $project->deleted_at->format('d/m/Y') : '' }}</td>

                    <td class="btn-td" >
                        <a href="{{ route('projects.edit', $project) }}" class="edit-btn btn btn-warning btn-sm mb-1">EDIT</a>
                        
                        @if(!$project->trashed())
                            <form class="mb-1" action="{{ route('projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit"  class="delete-btn btn btn-danger btn-sm" value="DELETE">
                            </form>
                        @endif

                        @if($project->trashed())
                            <form class="mb-1" action="{{ route('projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit"  class="delete-btn btn btn-danger btn-sm" value="DEL. DEFINITIVELY">
                            </form>

                            <form class="mb-1" action="{{ route('projects.restore', $project) }}" method="POST">
                                @csrf
                                <input type="submit"  class="delete-btn btn btn-success btn-sm" value="RESTORE">
                            </form>
                        @endif

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

</main>
@endsection