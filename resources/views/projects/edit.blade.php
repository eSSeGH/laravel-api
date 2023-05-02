@extends('layouts.app')

@section('content')
<main>

<div class="project-edit">

    <div class="container">

        <div class="card mx-auto my-5" style="max-width: 900px;">
            <div class="card-body">
                <h3 class="card-title" style="text-align:center;">Modifica: {{ $project->title }}</h5>

                <form action="{{ route('projects.update', $project) }}" method="POST">
                    {{-- controllo csrf  --}}
                    @csrf

                    {{-- specifico il metodo post:put --}}
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $project->title) }}">                      
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type-id" class="form-label">Tipologia:</label>
                        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type-id" value="{{ old('type_id') }}">
                            <option value="" selected>Seleziona tipologia</option>
                            @foreach($types as $type)
                                <option @selected( old('type_id', $project->type_id) == $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        
                        @error('type_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="technologies" class="form-label">Tecnologie:</label>
                        <div class="d-flex gap-3 flex-wrap @error('technologies') is-invalid @enderror">
                            @foreach($technologies as $key => $technology)
                                <div class="form-check">
                                    <input name="technologies[]" @checked( in_array( $technology->id, old('technologies', $project->technologies->pluck('id')->all() ) ) ) class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $technology->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        
                        @error('technologies')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione:</label>
                        <textarea type="textarea" row="5" cols="30" class="form-control @error('description') is-invalid @enderror" name="description" id="description">
                            {{ old('description', $project->description) }}
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Nome Cliente:</label>
                        <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" id="client_name" value="{{ old('client_name', $project->client_name) }}">
                        @error('client_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="client_tel" class="form-label">Telefono Cliente:</label>
                        <input type="text" class="form-control @error('client_tel') is-invalid @enderror" name="client_tel" id="client_tel" value="{{ old('client_tel', $project->client_tel) }}">
                        @error('client_tel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="btn-parent d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mx-auto">Invia</button>
                    </div>
                
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>

    </div>

</div>

</main>
@endsection