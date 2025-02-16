<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportXMLRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if you want to restrict access
    }

    public function rules()
    {
        return [
            'xml_file' => 'required|file|mimes:xml|max:2048', // Ensure it's an XML file and under 2MB
        ];
    }

    public function messages()
    {
        return [
            'xml_file.required' => 'The XML file is required.',
            'xml_file.file' => 'Please upload a valid file.',
            'xml_file.mimes' => 'Only XML files are allowed.',
            'xml_file.max' => 'The XML file must not be larger than 2MB.',
        ];
    }
}
