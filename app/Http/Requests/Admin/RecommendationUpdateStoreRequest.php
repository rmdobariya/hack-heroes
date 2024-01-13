<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RecommendationUpdateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recommendation_type' => 'required',
            'title_for_recommendation' => 'required',
            'sub_text_for_recommendation' => 'required',
            'recommendation' => 'required',
            'tags_for_associated_risk' => 'required',
            'reasoning' => 'required',
            'tags_for_age_appropriateness' => 'required',
            'tag_for_frequency' => 'required',
//            'tag_if_affiliate' => 'required',
//            'tag_if_resource' => 'required',
            'tags_for_visual_grouping' => 'required',
            'pdf' => 'mimes:pdf',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
