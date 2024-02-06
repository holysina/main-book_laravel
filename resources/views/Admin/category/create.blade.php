<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('category.store') }}" class="mt-6 space-y-6">
                        @csrf
                        
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" :value="__('Slug')" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug')" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-link-button-gray href="{{ route('category.index') }}">go back</x-link-button-gray>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" 
                                   x-show="show"
                                   x-transition
                                   x-init="setTimeout(() => show = false, 5000)"
                                   class="text-sm text-gray-600 dark:text-gray-400">
                                   {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
