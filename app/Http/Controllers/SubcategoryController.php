<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('search')) {

            $search = $request->input('search'); 

            $subcategories = Tag::SubCategories()->where('name', 'LIKE', '%' . $search . '%')
                ->with('parents')
                ->orderBy('parent_id','asc')
                ->paginate(20);

        } else {
            $subcategories = Tag::SubCategories()
            ->with('parents')
            ->orderBy('parent_id','asc')
            ->paginate(20);
        }

     

        return view('subcategorias.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbbiden');

        return view('subcategorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|required'
        ]);

        $categoria = Tag::create($validatedData);

        return redirect()->route('subcategorias.index')->with('success', 'La etiqueta fue creada satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $subcategory)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('subcategorias.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $subcategory)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Tag::categories()->get()->pluck('name','id');

        return view('subcategorias.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try { 

            $subcategory = Tag::findOrFail($id);          

            $validatedData = $request->validate([
                'name' => 'string|required',
                'category' => 'required'
            ]); 

            $subcategory->update([
                'name' => $validatedData['name'],
                'parent_id' => $validatedData['category']
            ]);
 
            return redirect()->route('subcategorias.index')->with('success', "La subcategoría fue actualizada satisfactoriamente");

        } catch (ValidationException $e) {

            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $subcategory)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategory->delete();

        return redirect()->route('subcategorias.index');
    }
}
