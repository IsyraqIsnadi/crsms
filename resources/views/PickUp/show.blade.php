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
                        <div class="mb-6">
                            <label for="id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pickup ID</label>
                            <input type="text" name="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $pick_up->id }}" readonly>
                          </div>
                          <div class="mb-6">
                            <label for="address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pickup Address</label>
                            <textarea id="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter pickup address" readonly>{{ $pick_up->address }}</textarea>
                          </div>
                          <div class="mb-6">
                            <label for="status" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Status</label>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">

                                @if ($pick_up->status == 'waiting_rider')
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 30%"></div>
                                @elseif ($pick_up->status == 'picking_up')
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 62%"></div>
                                @elseif ($pick_up->status == 'completed')
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                                @else
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                                @endif
                                    
                                <div class="grid grid-cols-4 gap-4">
                                    <div><p class="text-left">Invoice Made</p></div> 
                                    <div><p class="text-left">Waiting Rider</p></div>        
                                    <div><p class="text-center">Picking Up</p></div>          
                                    <div><p class="text-right">Completed</p></div>     
                                  </div>
                              </div>
                          </div>
                    </div>
                  
                    
                </div>
            </div>
        </div>
    </div>

    
    </div>
</x-app-layout>
