<?php

namespace App\Http\Requests;

use App\Models\Notification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'title' => ['required','string','min:2','max:255',Rule::unique(Notification::class)->ignore($this->id)],
            'description' => 'required|string|min:100',
        ];
    }
}
