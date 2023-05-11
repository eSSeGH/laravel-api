<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    public function index() {

        $projects = Project::limit(20)->get();

        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }

    public function show($slug) {

        $project = Project::where('slug', $slug)->first();

        dd($project);
        // non utilizziamo il get su uesto perchè non ci serve una collection con un solo elemento, è meglio
        // utilizzare first così ci ritrna direttamente uell'elemento

        if ($project) {

            return response()->json([
                'success' => true,
                'project' => $project
            ]);

        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun progetto trovato'
            ]);
        }
    }
}
