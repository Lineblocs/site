<?php namespace App\Http\Requests\Admin;

use App\SIPRouter;
use Illuminate\Foundation\Http\FormRequest;

class ServicePlanRequest extends FormRequest {

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
					'key_name' => 'required|min:1',
					'nice_name' => 'required|min:1'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'key_name' => 'required|min:1',
					'nice_name' => 'required|min:1'
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
