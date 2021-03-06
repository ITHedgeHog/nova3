<?php

namespace Nova\Departments\Controllers;

use Illuminate\Http\Request;
use Nova\Departments\Models\Department;
use Nova\Foundation\Controllers\Controller;
use Nova\Departments\Filters\DepartmentFilters;
use Nova\Departments\Responses\ShowDepartmentResponse;
use Nova\Departments\Responses\ShowAllDepartmentsResponse;

class ShowDepartmentController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function all(Request $request, DepartmentFilters $filters)
    {
        $this->authorize('viewAny', Department::class);

        $departments = Department::withCount('positions')
            ->filter($filters)
            ->orderBySort();

        $departments = ($request->has('reorder'))
            ? $departments->get()
            : $departments->paginate();

        return app(ShowAllDepartmentsResponse::class)->with([
            'departmentCount' => Department::count(),
            'departments' => $departments,
            'isReordering' => $request->has('reorder'),
            'search' => $request->search,
        ]);
    }

    public function show(Department $department)
    {
        $this->authorize('view', $department);

        return app(ShowDepartmentResponse::class)->with([
            'department' => $department->load('positions'),
        ]);
    }
}
