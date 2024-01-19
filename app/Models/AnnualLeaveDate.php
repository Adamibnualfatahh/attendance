<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeaveDate extends Model
{
    protected $fillable = [
        'annual_leave_id',
        'leave_date',
    ];

    protected $dates = [
        'leave_date',
    ];

    public function annualLeave()
    {
        return $this->belongsTo(AnnualLeave::class);
    }
}
