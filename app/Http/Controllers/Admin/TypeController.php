<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private $validations = [
        'name'         => 'required|string|max:50',
        'description'  => 'required|string|max:1000',
    ];

    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    
    public function create()
    {
        return view('Admin.types.create');
    }

    
    public function store(Request $request)
    {
        $request->validate($this->validations);

        $data = $request->all();
        // Salvare i dati nel database
        $newType = new Type();
        $newType->name          = $data['name'];
        $newType->description    = $data['description'];
        $newType->save();

        

        return redirect()->route('admin.type.show', ['type' => $newType]);
    }

    
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    
    public function update(Request $request, Type $type)
    {
        $request->validate($this->validations);

        $data = $request->all();
        
        
        $type->name          = $data['name'];
        $type->description    = $data['description'];
        $type->update();

        return redirect()->route('admin.type.show', ['type' => $type]);
    }

    
    public function destroy(Type $type)
    {
        $type->delete(); 
        return to_route('admin.type.index');
    }
}
