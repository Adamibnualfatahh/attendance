<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class CreateAnnualLeaveRequest  extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'reason' => 'required|string',
            'status' => 'nullable|string|in:pending,approved,rejected',
            'leave_dates' => 'required|array',
            'leave_dates.*.leave_date' => 'required|date',
        ];
    }
}
