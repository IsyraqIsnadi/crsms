<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pick Up') }}
        </h2>
    </x-slot>
    

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">
                    <div class="grid w-full place-items-center">
                    <form>   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search device name..." required>
                        </div>
                    </form>
                    </div>

                    <div class="overflow-x-auto mt-6 relative shadow-sm border sm:rounded-lg">

                        <div class="overflow-x-auto ">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            ID
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Pickup Address
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Status
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <span class="sr-only">View</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pick_ups !=null)
                                    
                                        @foreach ($pick_ups as $pick_up)
                                        
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 max-w-xs">
                                            {{ $pick_up->id }}
                                        </td>
                                        <td class="py-4 px-6 max-w-md" >
                                            {{ $pick_up->address }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($pick_up->status == 'waiting_rider')
                                                Waiting Rider
                                            @elseif ($pick_up->status == 'picking_up')
                                                Picking Up
                                            @elseif ($pick_up->status == 'completed')
                                                Completed
                                            @elseif ($pick_up->status == 'failed')
                                                Failed
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('pick_up.show', ['pick_up'=>$pick_up]) }}" class="btn text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View</a>
                                            @if (Auth::user()->hasRole('rider'))
                                                @if ($pick_up->status == 'waiting_rider')
                                                    <a class="btn text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href="{{ route('pick_up.rider_accept', ['pick_up'=>$pick_up]) }}">Accept</a>
                                                @endif
                                                @if ($pick_up->rider_id == Auth::user()->rider->id && $pick_up->status != 'completed')
                                                    <a class="btn text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href="{{ route('pick_up.edit', ['pick_up'=>$pick_up]) }}">Edit</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                        @endforeach
                                     @endif
                                </tbody>
                            </table>
                        </div>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
