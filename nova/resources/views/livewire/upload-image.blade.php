<div class="flex flex-col">
    <div class="w-full flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="text-center">
            @icon('image-add', 'mx-auto h-12 w-12 text-gray-400')
            <p x-data="{ focused: false }" class="mt-1 text-sm text-gray-600">
                <input
                    x-on:focus="focused = true"
                    x-on:blur="focused = false"
                    type="file"
                    id="upload-image"
                    wire:model="image"
                    class="sr-only"
                >
                <label
                    for="upload-image"
                    class="cursor-pointer font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out"
                    x-bind:class="{ 'outline-none underline': focused }"
                >
                    Upload a file
                </label>
            </p>
            <p class="mt-1 text-xs text-gray-500">
                PNG, JPG, GIF up to 5MB
            </p>
        </div>
    </div>

    <input type="hidden" name="image_path" wire:model="path">

    @error('image')
        <p class="flex items-center w-full relative mt-2 ml-0.5 text-sm text-red-600 space-x-2" role="alert">
            @icon('alert', 'h-5 w-5 flex-shrink-0 text-red-400')
            <span>{{ $message }}</span>
        </p>
    @enderror
</div>
