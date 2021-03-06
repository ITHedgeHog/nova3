<?php

namespace Nova\Departments\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use Illuminate\Support\Facades\Gate;
use Nova\Departments\Models\Department;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightSearchResult;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightCommandDependencies;

class CreatePosition extends SpotlightCommand
{
    protected string $name = 'Create Position';

    protected string $description = 'Create a new position';

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                SpotlightCommandDependency::make('department')
                    ->setPlaceholder('Which department do you want to create this position for?')
            );
    }

    public function searchDepartment($query)
    {
        return Department::where('name', 'like', "%${query}%")
            ->get()
            ->map(function ($department) {
                return new SpotlightSearchResult(
                    $department->id,
                    $department->name,
                    sprintf('Create position within %s', $department->name)
                );
            });
    }

    public function execute(Spotlight $spotlight, Department $department): void
    {
        $spotlight->redirectRoute('positions.create', "department={$department->id}");
    }

    public function shouldBeShown(): bool
    {
        return Gate::allows('create', Department::class);
    }
}
