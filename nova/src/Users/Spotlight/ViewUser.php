<?php

namespace Nova\Users\Spotlight;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;
use Nova\Users\Models\User;

class ViewUser extends SpotlightCommand
{
    protected string $name = 'View User';

    protected string $description = 'View a user profile';

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                SpotlightCommandDependency::make('user')
                    ->setPlaceholder('Which user do you want to view?')
            );
    }

    public function searchUser(Request $request, $query)
    {
        return User::where('name', 'like', "%${query}%")
            ->get()
            ->map(function ($user) {
                return new SpotlightSearchResult(
                    $user->id,
                    $user->name,
                    sprintf('Visit %s', $user->name)
                );
            });
    }

    public function execute(Spotlight $spotlight, User $user)
    {
        $spotlight->redirectRoute('users.show', $user);
    }

    public function shouldBeShown(): bool
    {
        return Gate::allows('viewAny', User::class);
    }
}
