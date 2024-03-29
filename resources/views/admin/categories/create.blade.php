<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('New') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.errors-message')
                    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="name">{{ __('Name') }}</label>
                        <input
                            id="name"
                            name="name"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                            type="text"
                            value=""/>
                        <button type="submit" class="flex justify-center items-center h-10 w-32 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600">{{ __('Create') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
