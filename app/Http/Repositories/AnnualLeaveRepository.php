<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\AnnualLeave;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeaveRepository
{
    public function create(array $data)
    {
        return AnnualLeave::create($data);
    }

    public function getAll()
    {
        return AnnualLeave::with('leaveDates')->get();
    }

    public function getById($id)
    {
        return AnnualLeave::with('leaveDates')->findOrFail($id);
    }
}
