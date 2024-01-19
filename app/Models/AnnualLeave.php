<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeave extends Model
{
    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];


    public function leaveDates()
    {
        return $this->hasMany(AnnualLeaveDate::class);
    }
}
