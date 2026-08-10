<?php

namespace App\Http\Requests;

use App\Models\Gift;
use App\Models\Wish;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreWishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user('child')->can('create', Wish::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gift_id' => [
                'required',
                'integer',
                'exists:gifts,id',
                Rule::unique('wishes')->where('child_id', $this->user('child')->id),
            ],
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $gift = Gift::find($this->integer('gift_id'));

                if ($gift && $gift->points > $this->user('child')->getAvailablePoints()) {
                    $validator->errors()->add('gift_id', 'Il ne te reste pas assez de bons points pour ce cadeau.');
                }
            },
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'gift_id.unique' => 'Ce cadeau est déjà dans ta liste de souhaits.',
        ];
    }
}
