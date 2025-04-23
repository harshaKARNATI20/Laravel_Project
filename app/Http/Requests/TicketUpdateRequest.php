<?php

namespace App\Http\Requests;

use App\Rules\OpenTicketDescriptionRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'summary' => 'required',
            'description' => [new OpenTicketDescriptionRule],
            'start_time' => ['required', 'date', 'after_or_equal:now'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'venue' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'ticket_limit' => 'required|integer|min:0',
            'status' => 'required|string',
        ];
    }
}
