<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="inline-flex">
                    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded-l" onclick="location.href='{{ url('/quotation') }}'">
                            All
                        </button>  
                    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded-l" onclick="location.href='{{ url('/pending') }}'">
                        Pending
                    </button>
                    <button class="bg-blue-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded-l" onclick="location.href='{{ url('/approved') }}'">
                        Approved
                    </button>
                    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded-l" onclick="location.href='{{ url('/rejected') }}'">
                        Rejected
                    </button>
                </div> 

                <div class="p-6 bg-white border-b border-gray-200">                   
                    <div class="overflow-x-auto">                       
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Device Name</th> 
                                    <th>Customer Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @php $no = 1; @endphp
                                @if ($service_requests !=null)
                                    @foreach ($service_requests as $service_request)
                                    @if ($service_request->customer_approval == 'yes')
                                    <tr>
                                        <th>{{ $no++ }}</th> 
                                        <td>{{ $service_request->device_name }}</td> 
                                        <td>
                                            @if ($service_request->customer_approval == null)
                                                Waiting Customer Approval
                                            @elseif ($service_request->customer_approval == 'yes')
                                                Approved by Customer
                                            @elseif ($service_request->customer_approval == 'no')
                                                Not Approved by Customer
                                            @endif
                                        </td> 
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('quotation.show', ['service_request'=>$service_request]) }}">View</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="3">You have no quotation</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>                      
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

