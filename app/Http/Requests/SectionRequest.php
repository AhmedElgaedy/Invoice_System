<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){
        $this->merge([
            'created_by' => auth()->user()->name
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'required|unique:sections,section_name|max:255',
            'description' => 'required',
            'created_by' =>  'required',
        ];
    }
    


    public function messages(){
        return [
           'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' => ' الوصف مطلوب '
        ];
    }

    


    public function failedValidation(Validator $validator){
        
            session()->flash('Error', $validator->errors()->toArray() );
            

        
        // return redirect()->route('sections.index');
    }
}
