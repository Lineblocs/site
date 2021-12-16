<?php namespace App\Http\Requests\Admin;

use App\NumberInventory;
use Illuminate\Foundation\Http\FormRequest;

class NumberInventoryRequest extends FormRequest {

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
					'number' => 'required|min:1',
					'api_number' => 'required|min:1',
					'region' => 'required|min:1',
					'country' => 'required|min:1',
					'routed_server' => 'required|min:1',
					'provider_id' => 'required|min:1',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'number' => 'required|min:1',
					'api_number' => 'required|min:1',
					'region' => 'required|min:1',
					'country' => 'required|min:1',
					'routed_server' => 'required|min:1',
					'provider_id' => 'required|min:1',
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
