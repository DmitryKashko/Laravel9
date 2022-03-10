<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|array',
            'project_id' => 'required|integer|exists:projects,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Это1 поле необходимо для заполнения',
            'title.string' => 'Данные должны соответсвовать строчному типу',
            'description.required' => 'Это2 поле необходимо для заполнения',
            'description.string' => 'Данные должны соответсвовать строчному типу',
            'project_id.required' => 'Это3 поле необходимо для заполнения',
            'project_id.integer' => 'ID категории должно быть числом',
            'project_id.exists' => 'ID категории должно быть в базе данных',
        ];
    }
}
