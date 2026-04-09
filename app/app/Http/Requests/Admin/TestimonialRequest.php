<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest {

	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			case 'PUT':
			case 'PATCH':
			{
				return [
					'name' => 'required|min:2',
					'job_title' => 'max:255',
					'company' => 'max:255',
					'rank' => 'required|integer',
					'testimonial_content' => 'required|min:3',
					'photo' => 'image|mimes:jpg,jpeg,png,gif|max:4096',
				];
			}
			default:break;
		}
	}

	public function authorize()
	{
		return true;
	}

}
