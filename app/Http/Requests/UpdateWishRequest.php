<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateWishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user('child')->can('update', $this->route('wish'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1|max:20',
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
                $wish = $this->route('wish');
                $child = $this->user('child');

                $pointsWithoutThisWish = $child->getSpentPoints() - $wish->quantity * $wish->gift->points;
                $pointsWithNewQuantity = $pointsWithoutThisWish + $this->integer('quantity') * $wish->gift->points;

                if ($pointsWithNewQuantity > $child->bonus_points) {
                    $validator->errors()->add('quantity', 'Cette quantité dépasse tes bons points disponibles.');
                }
            },
        ];
    }
}
