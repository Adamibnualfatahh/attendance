<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Repositories\AnnualLeaveRepository;
use App\Http\Requests\CreateAnnualLeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeaveController extends Controller
{
    protected $annualLeaveRepository;

    public function __construct(AnnualLeaveRepository $annualLeaveRepository)
    {
        $this->annualLeaveRepository = $annualLeaveRepository;
    }
    public function index(): JsonResponse
    {
        $annualLeaves = $this->annualLeaveRepository->getAll();
        return response()->json($annualLeaves);
    }

    public function store(CreateAnnualLeaveRequest $request): JsonResponse
    {
        $data = $request->validated();
        $annualLeave = $this->annualLeaveRepository->create($data);

        if (isset($data['leave_dates']) && is_array($data['leave_dates'])) {
            $annualLeave->leaveDates()->createMany($data['leave_dates']);
        }
        $annualLeave->load('leaveDates');

        return response()->json($annualLeave, 201);
    }

    public function show($id): JsonResponse
    {
        $annualLeave = $this->annualLeaveRepository->getById($id);
        return response()->json($annualLeave);
    }
}
