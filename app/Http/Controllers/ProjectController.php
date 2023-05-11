<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trashed = $request->input('trashed');

        // recupero id utente loggato
        $auth_id = Auth::id();

        if($trashed) {
            // per il with eager loading su doc
            $projects = Project::onlyTrashed()->with('technologies:id,name', 'type:id,name', 'user')->where('user_id', $auth_id)->get();
        } else {
            $projects = Project::with('technologies:id,name', 'type:id,name', 'user')->where('user_id', $auth_id)->get();
        }

        $num_of_trashed = Project::onlyTrashed()->count();

        return view('projects.index', compact('projects', 'trashed', 'num_of_trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num_of_trashed = Project::onlyTrashed()->count();

        $types = Type::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('projects.create', compact('num_of_trashed', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug( $data['title'] );

        $data['user_id'] = Auth::id();

        $project = Project::create($data);

        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }

        return to_route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $num_of_trashed = Project::onlyTrashed()->count();

        if($project->user_id == Auth::id() ) {

            return view('projects.show', compact('project', 'num_of_trashed'));
        } else {

            abort(403, 'Azione non autorizzata.');
        }
    }

     /**
     * Restore the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, Project $project)
    {

        if($project->user_id == Auth::id() ) {

            if ($project->trashed()) {
                $project->restore();

                $request->session()->flash('message', 'Il progetto è stato ripristinato correttamente.');
            }
    
            // uesta funzione helpers 'back()' ci rimanda indietro alla pagina nella uale abbiamo invocato il restore
            // in uesto caso è utile perchè abbiamo un pulsante restore sia nella pagina index che nella pagina 
            // show, e uindi non importa dove lo clicchiamo: ritorneremo alla pagina dove lo abbiamo cliccato
            return back();

        } else {

            abort(403, 'Azione non autorizzata.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $num_of_trashed = Project::onlyTrashed()->count();

        $types = Type::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();

        if($project->user_id == Auth::id() ) {

            return view('projects.edit', compact('project', 'num_of_trashed', 'types', 'technologies'));
        } else {

            abort(403, 'Azione non autorizzata.');
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug( $data['title'] );

        // sincronizzo le tecnologie che ci arrivano dalla richiesta con uelle del project, altrimenti (se deselezionate) faccio in modo di cancellarle
        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        if($project->user_id == Auth::id() ) {

            $project->update($data);

            return to_route('projects.show', $project);
        } else {

            abort(403, 'Azione non autorizzata.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->user_id == Auth::id() ) {

            if($project->trashed()) {
                $project->forceDelete();
                // eliminazione definitiva
            } else {
                $project->delete(); 
                // eliminazione soft
            }
    
            return back();
        } else {

            abort(403, 'Azione non autorizzata.');
        }
    }
}
