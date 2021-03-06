@extends($__novaTemplate)

@section('content')
    <x-page-header title="Add Note">
        <x-slot name="pretitle">
            <a href="{{ route('notes.index') }}">Notes</a>
        </x-slot>
    </x-page-header>

    <x-under-construction feature="My Notes">
        <li>We are using the Trix editor right now, but will likely use a completely different rich text editor by the time Nova 3 launches</li>
        <li>There are known issues with the display of HTML created with the rich text editor</li>
    </x-under-construction>

    <x-panel>
        <x-form :action="route('notes.store')">
            <div class="px-4 pt-4 space-y-8 | sm:pt-6 sm:px-6">
                <x-input.group label="Title" for="title" :error="$errors->first('title')" class="sm:w-1/2">
                    <x-input.text id="title" name="title" :value="old('title')" data-cy="title" />
                </x-input.group>

                <x-input.group label="Summary" for="summary" :error="$errors->first('summary')" class="sm:w-2/3">
                    <x-input.textarea id="summary" name="summary" rows="3" data-cy="summary">{{ old('summary') }}</x-input.textarea>
                </x-input.group>

                <x-input.group for="content" :error="$errors->first('content')">
                    {{-- <x-input.rich-text name="content" :initial-value="old('content')" /> --}}
                    <posts-editor></posts-editor>
                </x-input.group>
            </div>

            <x-form.footer>
                <x-button type="submit" color="blue">Add Note</x-button>
                <x-button-link :href="route('notes.index')" color="white">Cancel</x-button-link>
            </x-form.footer>
        </x-form>
    </x-panel>
@endsection

@push('scripts')
    @once
        <script src="{{ asset('dist/js/editor-tiptap.js') }}"></script>
    @endonce
@endpush

@push('styles')
    @once
        <link rel="stylesheet" href="{{ asset('dist/css/tiptap.css') }}">
    @endonce
@endpush