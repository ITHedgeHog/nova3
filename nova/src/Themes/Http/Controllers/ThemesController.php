<?php

namespace Nova\Themes\Http\Controllers;

use Nova\Themes\Jobs;
use Nova\Themes\Theme;
use Nova\Themes\Events;
use Nova\Themes\Http\Responses;
use Nova\Themes\Http\Requests\EditThemeRequest;
use Nova\Foundation\Http\Controllers\Controller;
use Nova\Themes\Http\Requests\CreateThemeRequest;

class ThemesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        return app(Responses\ManageThemesResponse::class)->with([
            'themes' => Theme::get()
        ]);
    }

    public function create()
    {
        return app(Responses\CreateThemeResponse::class);
    }

    public function store(CreateThemeRequest $request)
    {
        $theme = dispatch_now(new Jobs\CreateThemeJob($request->validated()));

        event(new Events\ThemeCreated($theme));

        return redirect()->route('themes.index');
    }

    public function edit(Theme $theme)
    {
        return app(Responses\EditThemeResponse::class)->with([
            'theme' => $theme
        ]);
    }

    public function update(EditThemeRequest $request, Theme $theme)
    {
        $theme = dispatch_now(new Jobs\UpdateThemeJob($theme, $request->validated()));

        event(new Events\ThemeUpdated($theme->fresh()));

        return redirect()->route('themes.index');
    }

    public function destroy(Theme $theme)
    {
        $theme = dispatch_now(new Jobs\DeleteThemeJob($theme));

        event(new Events\ThemeDeleted($theme));

        return response()->json($theme);
    }
}