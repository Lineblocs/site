<?php namespace App\Http\Requests\Admin;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class SupportTicketRequest extends FormRequest {

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
					'subject' => 'required|min:3',
					'comment' => 'required|min:50',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'subject' => 'required|min:3',
					'comment' => 'required|min:50',
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
