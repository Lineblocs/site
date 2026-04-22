<?php namespace App\Http\Requests\Admin;

use App\RTPEngine;
use Illuminate\Foundation\Http\FormRequest;

class RTPEngineRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
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
			{
				return [
					'socket' => 'required|min:1',
					'set_id' => 'required|min:1'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'socket' => 'required|min:1',
					'set_id' => 'required|min:1'
				];
			}
			default:break;
		}
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
