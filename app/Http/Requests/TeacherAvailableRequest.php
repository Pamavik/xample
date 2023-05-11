<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Factory as ValidationFactory;

class TeacherAvailableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /*public function authorize(): bool
    {
        return false;
    }*/

    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'teacher',
            function ($attribute, $value, $parameters) {
                try {
                    $teacher = User::findOrFail($value);
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                    return false;
                }
                if ($teacher->role == 'teacher') {
                    return true;
                }
            },
            'Sorry, it failed teacher validation!'
        );

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'teacher_id' => ['ulid', 'teacher'],
        ];
    }
}
