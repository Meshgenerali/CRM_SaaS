@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <!-- <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </div> -->

        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ $content }}
        </div>
    </div>
</x-modal>
