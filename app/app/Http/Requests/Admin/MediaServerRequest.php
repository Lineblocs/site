<?php namespace App\Http\Requests\Admin;

use App\MediaServer;
use Illuminate\Foundation\Http\FormRequest;

class MediaServerRequest extends FormRequest {

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
					'name' => 'required|min:1',
					'ip_address' => 'required|min:1',
					'ip_address_range' => 'required'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'name' => 'required|min:1',
					'ip_address' => 'required|min:1',
					'ip_address_range' => 'required'
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
