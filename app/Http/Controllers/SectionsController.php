<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Http\Requests\SectionRequest;
class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Section = Section::all();
        return view('sections.sections',compact('Section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( SectionRequest $request)
    {
            if (!session()->has('Erorr')) {
                $record = Section::create($request->validated());
                        if($record){
                            session()->flash('Add', 'تم اضافة القسم بنجاح ');
                        }
            }
   return redirect()->route('sections.index');

           

        }

    /**
     * Display the specified resource.
     */
    public function show(Section $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $sections = Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect()->route('sections.index');
    }
}
