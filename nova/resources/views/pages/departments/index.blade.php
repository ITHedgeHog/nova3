@extends($__novaTemplate)

@section('content')
    <x-page-header title="Departments">
        <x-slot name="controls">
            @if ($departmentCount > 0)
                @can('update', $departments->first())
                    <x-button-link :href="route('departments.index', 'reorder')" color="gray-text" size="none">
                        @icon('arrow-sort', 'h-6 w-6')
                    </x-button-link>
                @endcan

                @can('create', 'Nova\Departments\Models\Department')
                    <x-button-link :href="route('departments.create')" color="blue" data-cy="create">
                        Add Department
                    </x-button-link>
                @endcan
            @endif
        </x-slot>
    </x-page-header>

    @if ($departmentCount === 0)
        <x-empty-state
            image="organizer"
            message="Departments allow you to organize character positions into logical groups that you can display on your manifests."
            label="Add a deparment now"
            :link="route('departments.create')"
        ></x-empty-state>
    @else
        <x-panel x-data="sortableList">
            @if ($isReordering)
                <div class="bg-purple-100 border-t border-b border-purple-200 p-4 | sm:rounded-t-md sm:border-t-0">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            @icon('arrow-sort', 'h-6 w-6 text-purple-600')
                        </div>
                        <div class="ml-3">
                            <h3 class="font-medium text-purple-900">
                                Change Sorting Order
                            </h3>
                            <div class="mt-2 text-sm text-purple-800">
                                <p>Departments appear in the order you set throughout Nova. To change the sorting of the departments, drag them to the desired order and then click Save Sort Order below.</p>
                            </div>
                            <div class="mt-4">
                                <x-form :action="route('departments.reorder')" id="form-reorder" :divide="false">
                                    <input type="hidden" name="sort" x-model="newSortOrder">
                                    <div class="flex items-center space-x-4">
                                        <x-button type="submit" form="form-reorder" color="purple">Save Sort Order</x-button>
                                        <x-button-link :href="route('departments.index')" color="purple-text" size="none">
                                            Cancel
                                        </x-button-link>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="px-4 py-2 | sm:px-6 sm:py-3">
                    <x-search-filter placeholder="Find a department..." :search="$search" />
                </div>
            @endif

            <ul id="sortable-list">
            @forelse ($departments as $department)
                <li class="sortable-item border-t border-gray-200 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out @if ($isReordering) first:border-0 last:rounded-b-md @endif" data-id="{{ $department->id }}">
                    <div class="block">
                        <div class="px-4 py-4 flex items-center | sm:px-6">
                            @if ($isReordering)
                                <div class="sortable-handle flex-shrink-0 cursor-move mr-5">
                                    @icon('reorder', 'h-5 w-5 text-gray-400')
                                </div>
                            @endif
                            <div class="min-w-0 flex-1 | sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <div class="font-medium truncate">
                                        {{ $department->name }}
                                    </div>
                                    <div class="mt-2 flex">
                                        <div>
                                            @if ($department->active)
                                                <x-badge size="xs" color="green">Active</x-badge>
                                            @else
                                                <x-badge size="xs" color="gray">Inactive</x-badge>
                                            @endif
                                        </div>

                                        <div class="hidden items-center text-sm text-gray-500 ml-6 | sm:flex">
                                            {{ $department->positions_count }} @choice('position|positions', $department->positions_count)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-5 flex-shrink-0 leading-0">
                                <x-dropdown placement="bottom-end">
                                    <x-slot name="trigger">@icon('more', 'h-6 w-6')</x-slot>

                                    <x-dropdown.group>
                                        @can('view', $department)
                                            <x-dropdown.item :href="route('departments.show', $department)" icon="show" data-cy="view">
                                                <span>View</span>
                                            </x-dropdown.item>
                                        @endcan

                                        @can('update', $department)
                                            <x-dropdown.item :href="route('departments.edit', $department)" icon="edit" data-cy="edit">
                                                <span>Edit</span>
                                            </x-dropdown.item>
                                        @endcan
                                    </x-dropdown.group>

                                    @can('update', $department)
                                        <x-dropdown.group>
                                            <x-dropdown.item :href="route('positions.index', $department)" icon="list" data-cy="edit">
                                                <span>Positions</span>
                                            </x-dropdown.item>
                                        </x-dropdown.group>
                                    @endcan

                                    @can('delete', $department)
                                        <x-dropdown.group>
                                            <x-dropdown.item type="button" icon="delete" x-on:click="$dispatch('dropdown-toggle');$dispatch('modal-load', {{ json_encode($department) }});" data-cy="delete">
                                                <span>Delete</span>
                                            </x-dropdown.item>
                                        </x-dropdown.group>
                                    @endcan
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <x-search-not-found>
                    No departments found
                </x-search-not-found>
            @endforelse
            </ul>

            @if (! $isReordering)
                <div class="px-4 py-2 border-t border-gray-200 | sm:px-6 sm:py-3">
                    {{ $departments->withQueryString()->links() }}
                </div>
            @endif
        </x-panel>

        <x-tips section="departments" />

        <x-modal color="red" title="Delete Department?" icon="warning" :url="route('departments.delete')">
            <x-slot name="footer">
                <span class="flex w-full | sm:col-start-2">
                    <x-button type="submit" form="form" class="red" full-width>
                        Delete
                    </x-button>
                </span>
                <span class="mt-3 flex w-full | sm:mt-0 sm:col-start-1">
                    <x-button x-on:click="$dispatch('modal-close')" type="button" color="white" full-width>
                        Cancel
                    </x-button>
                </span>
            </x-slot>
        </x-modal>
    @endif
@endsection
