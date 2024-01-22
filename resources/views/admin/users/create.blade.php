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
                    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="username">{{ __('Username') }}</label>
                        <input
                            id="username"
                            name="username"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                            type="text"
                            value=""/>
                        <label for="name">{{ __('Name') }}</label>
                        <input
                            id="name"
                            name="name"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                            type="text"
                            value=""/>
                        <label for="email">{{ __('Email') }}</label>
                        <input
                            id="email"
                            name="email"
                            class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                            type="text"
                            value=""/>

                        <label for="password">{{ __('Password') }}</label>
                        <input
                                id="password"
                                name="password"
                                class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                                type="text"
                                value=""/>
                        <label for="balance">{{ __('Balance') }}</label>
                        <input
                                id="balance"
                                name="balance"
                                class="w-full h-10 px-3 mb-2 text-base text-gray-700 border rounded-lg focus:shadow-outline"
                                type="number"
                                value=""/>
{{--                        @isset($user->photo)--}}
{{--                            <img class="w-10 h-10 rounded-full object-cover"--}}
{{--                                 src="{{ asset('/storage/' . $user->photo) }}">--}}
{{--                            <label for="delete_photo">Delete photo</label>--}}
{{--                            <input name="delete_photo" type="checkbox"/>--}}
{{--                        @else--}}
{{--                            {!! Avatar::create($user->name)->toSvg() !!}--}}
{{--                        @endisset--}}
                        <div class="flex flex-col">
                            <label for="photo">{{__('Profile photo')}}</label>
                            <input
                                id="photo"
                                name="photo"
                                class="h-10 mt-2  text-base text-gray-700 focus:shadow-outline"
                                type="file"
                            />
                        </div>
                        <button type="submit" class="flex justify-center items-center h-10 w-32 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
