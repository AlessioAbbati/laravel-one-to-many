<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $validations = [
        'title'             => 'required|string|max:50',
        'category_id'       => 'required|integer|exists:categories,id',
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(3);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati 
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();
        // Salvare i dati nel database
        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->author = $data['author'];
        $newProject->creation_date = $data['creation_date'];
        $newProject->last_update = $data['last_update'];
        $newProject->collaborators = $data['collaborators'];
        $newProject->description = $data['description'];
        $newProject->languages = $data['languages'];
        $newProject->link_github = $data['link_github'];
        $newProject->save();

        // return 'commentare se serve debuggare';
        // $newComic = Comic::create($data);

        return redirect()->route('Admin.project.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // validare i dati 
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();
        // Salvare i dati nel database
        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->author = $data['author'];
        $newProject->creation_date = $data['creation_date'];
        $newProject->last_update = $data['last_update'];
        $newProject->collaborators = $data['collaborators'];
        $newProject->description = $data['description'];
        $newProject->languages = $data['languages'];
        $newProject->link_github = $data['link_github'];
        $newProject->update();

        // return 'commentare se serve debuggare';
        // $newComic = Comic::create($data);

        return redirect()->route('Admin.project.show', ['project' => $newProject]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
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
