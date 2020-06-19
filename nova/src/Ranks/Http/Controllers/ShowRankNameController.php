<?php

namespace Nova\Ranks\Http\Controllers;

use Illuminate\Http\Request;
use Nova\Ranks\Models\RankName;
use Nova\Ranks\Filters\RankNameFilters;
use Nova\Foundation\Http\Controllers\Controller;
use Nova\Ranks\Http\Responses\ShowRankNameResponse;
use Nova\Ranks\Http\Responses\ShowAllRankNamesResponse;

class ShowRankNameController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function all(Request $request, RankNameFilters $filters)
    {
        $this->authorize('viewAny', RankName::class);

        $names = RankName::orderBy('name')
            ->filter($filters)
            ->paginate();

        return app(ShowAllRankNamesResponse::class)->with([
            'names' => $names,
            'search' => $request->search,
        ]);
    }

    public function show(RankName $name)
    {
        $this->authorize('view', $name);

        return app(ShowRankNameResponse::class)->with([
            'name' => $name,
        ]);
    }
}
