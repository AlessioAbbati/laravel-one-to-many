<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $validations = [
        'title'             => 'required|string|max:50',
        'type_id'           => 'required|integer|exists:categories,id',
        'author'            => 'required|string|max:30',
        'creation_date'     => 'required|date',
        'last_update'       => 'required|date',
        'collaborators'     => 'string|max:150',
        'description'       => 'string',
        'languages'         => 'required|string|max:50',
        'link_github'       => 'required|url|max:200',
        
    ];

    private $validations_messages = [
        'required'      => 'il campo :attribute è obbligatorio',
        'max'           => 'il campo :attribute deve avere almeno :max caratteri',
        'url'           => 'il campo deve essere un url valido',
        'exists'        => 'Valore non valido',
    ];

    
    public function index()
    {
        $projects = Project::paginate(3);
        return view('admin.projects.index', compact('projects'));
    }

    
    public function create()
    {
        return view('Admin.projects.create');
    }

    
    public function store(Request $request)
    {
        // validare i dati 
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();
        // Salvare i dati nel database
        $newProject = new Project();
        $newProject->title          = $data['title'];
        $newProject->type_id        = $data['type_id'];
        $newProject->author         = $data['author'];
        $newProject->creation_date  = $data['creation_date'];
        $newProject->last_update    = $data['last_update'];
        $newProject->collaborators  = $data['collaborators'];
        $newProject->description    = $data['description'];
        $newProject->languages      = $data['languages'];
        $newProject->link_github    = $data['link_github'];
        $newProject->save();

        // return 'commentare se serve debuggare';
        // $newComic = Comic::create($data);

        return redirect()->route('Admin.project.show', ['project' => $newProject]);
    }

    
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

   
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    
    public function update(Request $request, Project $project)
    {
        // validare i dati 
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();
        
        
        $project->title             = $data['title'];
        $project->type_id           = $data['type_id'];
        $project->author            = $data['author'];
        $project->creation_date     = $data['creation_date'];
        $project->last_update       = $data['last_update'];
        $project->collaborators     = $data['collaborators'];
        $project->description       = $data['description'];
        $project->languages         = $data['languages'];
        $project->link_github       = $data['link_github'];
        $project->update();

       

        return redirect()->route('Admin.project.show', ['project' => $project]);
    }

   
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        // $projects = project::all(); // SELECT * FROM `projects`
        $trashedProjects = Project::onlyTrashed()->paginate(3);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->forceDelete();

        return to_route('admin.project.trashed')->with('delete_success', $project);
    }
}
