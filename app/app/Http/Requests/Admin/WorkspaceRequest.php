<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WorkspaceRequest extends FormRequest
{
    public function rules()
    {
        return array(
            'name' => 'required',
            'active' => 'required',
            'grace_period_extension' => 'integer|min:0',
        );
    }

    public function authorize()
    {
        return true;
    }
}
