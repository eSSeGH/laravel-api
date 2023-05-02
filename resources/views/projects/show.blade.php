@extends('layouts.app')

@section('content')
<main>

<div class="container">

    <div class="card mx-auto mt-5">
        <div class="card-body">
            <h2 class="card-title" style="color: cornflowerblue;">
                {{$project['title']}}
                @if($project->type)
                    <span class="badge rounded-pill bg-warning">{{ $project->type->name }}</span>
                @else
                    <span class="badge rounded-pill bg-warning">nessuna categoria</span>
                @endif
            </h2>

            <h4 class="card-text">Tecnologie: 
                @forelse ($project->technologies as $technology)
                    <span style="font-size: 0.8rem;">{{ $technology->name }}</span>
                @empty
                    -
                @endforelse
            </h4>
            <h4 class="card-text">Descrizione: 
                <p style="font-size: 0.8rem;">{{ $project['description']}}</p>
            </h4>
            <h4 class="card-text">Nome Cliente: 
                <span style="font-size: 0.8rem;">{{ $project['client_name'] }} </span>
            </h4>
            <h4 class="card-text">Numero di Telefono: 
                <span style="font-size: 0.8rem;">{{ $project['client_tel'] }}</span>
            </h4>
            <h4 class="card-text">Creato il: 
                <span style="font-size: 0.8rem;">{{ $project['created_at']->format('d/m/Y') }}</span>
            </h4>
            <h4 class="card-text">Aggiornato il: 
                <span style="font-size: 0.8rem;">{{ $project['updated_at']->format('d/m/Y') }}</span>
            </h4>

            @if($project->trashed())
                <h4 class="card-text">Eliminato il: 
                    <span style="font-size: 0.8rem;">{{ $project->deleted_at->format('d/m/Y') }}</span>
                </h4>
            @endif

            <div class="options-btn d-flex justify-content-center">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm me-1">EDIT</a>

                @if(!$project->trashed())
                    <form class="me-1" action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit"  class="delete-btn btn btn-danger btn-sm" value="DELETE">
                    </form>
                @endif

                @if($project->trashed())
                    <form class="me-1" action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit"  class="delete-btn btn btn-danger btn-sm" value="DEL. DEFINITIVELY">
                    </form>

                    <form class="me-1" action="{{ route('projects.restore', $project) }}" method="POST">
                        @csrf
                        <input type="submit"  class="delete-btn btn btn-success btn-sm" value="RESTORE">
                    </form>
                @endif
            
            </div>
        </div>
    </div>

</div>

</main>
@endsection