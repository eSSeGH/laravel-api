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
            'results' => $projects
        ]);
    }
}
