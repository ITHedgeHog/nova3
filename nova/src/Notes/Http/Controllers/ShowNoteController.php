<?php

namespace Nova\Notes\Http\Controllers;

use Nova\Notes\Models\Note;
use Illuminate\Http\Request;
use Nova\Notes\Filters\NoteFilters;
use Nova\Notes\Http\Responses\ShowNoteResponse;
use Nova\Foundation\Http\Controllers\Controller;
use Nova\Notes\Http\Responses\ShowAllNotesResponse;

class ShowNoteController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function all(Request $request, NoteFilters $filters)
    {
        $this->authorize('viewAny', Note::class);

        $notes = Note::whereAuthor(auth()->user())
            ->filter($filters)
            ->orderBy('title')
            ->paginate();

        return app(ShowAllNotesResponse::class)->with([
            'notes' => $notes,
            'search' => $request->search,
        ]);
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note);

        return app(ShowNoteResponse::class)->with([
            'note' => $note,
        ]);
    }
}
