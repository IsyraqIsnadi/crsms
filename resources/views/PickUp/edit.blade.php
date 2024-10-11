<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pick Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('pick_up.update',['pick_up'=>$pick_up]) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <label for="id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pickup ID</label>
                            <input type="text" name="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pick_up->id }}" readonly>
                            <br>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select status</label>
                                <select id="stats" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="completed">Completed</option> 
                                    <option value="failed">Failed</option>
                                </select>
                                <br>
                            <input class="btn mt-3" type="submit">                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
