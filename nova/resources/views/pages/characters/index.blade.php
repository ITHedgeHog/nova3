@extends($__novaTemplate)

@section('content')
    <x-page-header>
        <x-slot name="title">
            @if (request()->has('status'))
                {{ ucfirst(request()->status) }}
            @endif
            Characters
        </x-slot>

        <x-slot name="controls">
            <x-dropdown placement="bottom-end" wide>
                <x-slot name="trigger">@icon('filter', 'h-6 w-6')</x-slot>

                <x-dropdown.group>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&hasuser=1')">
                        <div class="flex items-center justify-between w-full">
                            <span>Assigned to a user</span>
                            @if (request()->has('hasuser'))
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&nouser=1')">
                        <div class="flex items-center justify-between w-full">
                            <span>Not assigned to a user</span>
                            @if (request()->has('nouser'))
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&noposition=1')">
                        <div class="flex items-center justify-between w-full">
                            <span>Not assigned a position</span>
                            @if (request()->has('noposition'))
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                </x-dropdown.group>

                <x-dropdown.group>
                    <x-dropdown.text class="uppercase tracking-wide font-semibold text-gray-500">
                        Filter by character type
                    </x-dropdown.text>

                    <x-dropdown.item :href="route('characters.index', 'status='.request('status'))">
                        All character types
                    </x-dropdown.item>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&type=primary')">
                        <div class="flex items-center justify-between w-full">
                            <span>Primary characters</span>
                            @if (request('type') === 'primary')
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&type=secondary')">
                        <div class="flex items-center justify-between w-full">
                            <span>Secondary characters</span>
                            @if (request('type') === 'secondary')
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                    <x-dropdown.item :href="route('characters.index', 'status='.request('status').'&type=support')">
                        <div class="flex items-center justify-between w-full">
                            <span>Support characters</span>
                            @if (request('type') === 'support')
                                @icon('check', 'h-5 w-5')
                            @endif
                        </div>
                    </x-dropdown.item>
                </x-dropdown.group>
            </x-dropdown>

            @can('create', 'Nova\Characters\Models\Character')
                <x-button-link :href="route('characters.create')" color="blue" data-cy="create">
                    Add Character
                </x-button-link>
            @endcan
        </x-slot>
    </x-page-header>

    <x-panel>
        <div>
            <div class="p-4 | sm:hidden">
                <select x-on:change="window.location.replace($event.target.value)" aria-label="Selected tab" class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring focus:border-blue-300 sm:text-sm transition ease-in-out duration-150">
                    <option value="{{ route('characters.index', 'status=active') }}"{{ request()->status === 'active' ? 'selected' : '' }}>Active Characters</option>
                    <option value="{{ route('characters.index', 'status=pending') }}"{{ request()->status === 'pending' ? 'selected' : '' }}>Pending Characters</option>
                    <option value="{{ route('characters.index', 'status=inactive') }}"{{ request()->status === 'inactive' ? 'selected' : '' }}>Inactive Characters</option>
                    <option value="{{ route('characters.index') }}"{{ !request()->has('status') ? 'selected' : '' }}>All Characters</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200 px-4 | sm:px-6">
                    <nav class="-mb-px flex">
                        <a
                            href="{{ route('characters.index', 'status=active') }}"
                            class="whitespace-nowrap ml-8 first:ml-0 py-4 px-1 border-b-2 border-transparent font-medium text-sm focus:outline-none @if (request()->status === 'active') border-blue-500 text-blue-600 @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif"
                        >
                            Active
                        </a>
                        <a
                            href="{{ route('characters.index', 'status=pending') }}"
                            class="whitespace-nowrap ml-8 first:ml-0 py-4 px-1 border-b-2 border-transparent font-medium text-sm focus:outline-none @if (request()->status === 'pending') border-blue-500 text-blue-600 @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif"
                        >
                            Pending
                        </a>
                        <a
                            href="{{ route('characters.index', 'status=inactive') }}"
                            class="whitespace-nowrap ml-8 first:ml-0 py-4 px-1 border-b-2 border-transparent font-medium text-sm focus:outline-none @if (request()->status === 'inactive') border-blue-500 text-blue-600 @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif"
                        >
                            Inactive
                        </a>
                        <a
                            href="{{ route('characters.index') }}"
                            class="whitespace-nowrap ml-8 first:ml-0 py-4 px-1 border-b-2 border-transparent font-medium text-sm focus:outline-none @if (!request()->has('status')) border-blue-500 text-blue-600 @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif"
                        >
                            All Characters
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="px-4 py-2 | sm:px-6 sm:py-3">
            <x-search-filter placeholder="Find a character..." :search="$search" />
        </div>

        <ul>
        @forelse ($characters as $character)
            <li class="border-t border-gray-200">
                <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex items-center px-4 py-4 | sm:px-6">
                        <div class="min-w-0 flex-1 flex items-center">
                            <div class="min-w-0 flex-1 pr-4 | md:grid md:grid-cols-2 md:gap-4">
                                <div>
                                    <x-avatar-meta :src="$character->avatar_url">
                                        <x-slot name="primaryMeta">
                                            {{ optional(optional($character->rank)->name)->name }}
                                            {{ $character->name }}
                                        </x-slot>

                                        <x-slot name="secondaryMeta">
                                            {{ $character->positions->implode('name', ' & ') }}
                                        </x-slot>
                                    </x-avatar-meta>
                                </div>
                                <div>
                                    <div class="flex">
                                        <x-badge size="xs" :color="$character->type->color()">
                                            {{ $character->type->displayName() }}
                                        </x-badge>
                                    </div>
                                    @if ($character->users->count() > 0)
                                        <div class="hidden mt-2 items-center text-sm text-gray-500 | sm:flex">
                                            @if ($character->users->count() === 1)
                                                @icon('user', 'flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400')
                                            @else
                                                @icon('users', 'flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400')
                                            @endif

                                            <span>
                                                Played by {{ $character->users->implode('name', ' & ') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="leading-0">
                            <x-dropdown placement="bottom-end">
                                <x-slot name="trigger">@icon('more', 'h-6 w-6')</x-slot>

                                <x-dropdown.group>
                                    @can('view', $character)
                                        <x-dropdown.item :href="route('characters.show', $character)" icon="show" data-cy="view">
                                            <span>View</span>
                                        </x-dropdown.item>
                                    @endcan

                                    @can('update', $character)
                                        <x-dropdown.item :href="route('characters.edit', $character)" icon="edit" data-cy="edit">
                                            <span>Edit</span>
                                        </x-dropdown.item>
                                    @endcan
                                </x-dropdown.group>

                                @can('activate', $character)
                                    <x-dropdown.group>
                                        <x-dropdown.item type="submit" icon="check-alt" form="activate" data-cy="activate">
                                            <span>Activate</span>

                                            <x-slot name="buttonForm">
                                                <x-form :action="route('characters.activate', $character)" id="activate" />
                                            </x-slot>
                                        </x-dropdown.item>
                                    </x-dropdown.group>
                                @endcan

                                @can('deactivate', $character)
                                    <x-dropdown.group>
                                        <x-dropdown.item type="button" icon="remove-alt" data-cy="deactivate" x-on:click="$dispatch('dropdown-toggle');$dispatch('modal-deactivate', {{ json_encode($character) }});">
                                            <span>Deactivate</span>
                                        </x-dropdown.item>
                                    </x-dropdown.group>
                                @endcan

                                @can('delete', $character)
                                    <x-dropdown.group>
                                        <x-dropdown.item type="button" icon="delete" data-cy="delete" x-on:click="$dispatch('dropdown-toggle');$dispatch('modal-load', {{ json_encode($character) }});">
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
                No characters found
            </x-search-not-found>
        @endforelse
        </ul>

        <div class="px-4 py-2 border-t border-gray-200 | sm:px-6 sm:py-3">
            {{ $characters->withQueryString()->links() }}
        </div>
    </x-panel>

    <x-tips section="characters" />

    <x-modal color="red" title="Delete character?" icon="warning" :url="route('characters.delete')">
        <x-slot name="footer">
            <span class="flex w-full | sm:col-start-2">
                <x-button type="submit" form="form" color="red" full-width>
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

    <x-modal color="blue" title="Deactivate character?" icon="duplicate" :url="route('characters.confirm-deactivate')" event="modal-deactivate">
        <x-slot name="footer">
            <span class="flex w-full | sm:col-start-2">
                <x-button type="submit" form="form-deactivate" color="blue" full-width>
                    Deactivate
                </x-button>
            </span>
            <span class="mt-3 flex w-full | sm:mt-0 sm:col-start-1">
                <x-button x-on:click="$dispatch('modal-close')" type="button" color="white" full-width>
                    Cancel
                </x-button>
            </span>
        </x-slot>
    </x-modal>
@endsection
