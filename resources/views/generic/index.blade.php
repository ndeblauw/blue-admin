<x-ba-admin-layout>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-t-2 border-{{$config->color ?? 'blue-200'}} sm:rounded-b-lg">

                    <div class="bg-gray-50 px-6 flex justify-between">
                        <div class="text-left font-bold text-gray-500 uppercase tracking-wider py-5 ">
                            {{$config->name_to_use}}
                        </div>
                        <x-ba-admin-button href="{{$config->getCreateUrl()}}" class="py-1 bg-green-500 text-xs my-auto">
                            {{__('Create New')}}
                        </x-ba-admin-button>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200" id="indexTable">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{$config->titleField()}}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($models as $model)
                            <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif hover:bg-gray-100">
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    @php $titlefield = $config->titleField() @endphp
                                    {{$model->$titlefield}}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{$config->getShowUrl($model->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>
                                    <a href="{{$config->getEditUrl($model->id)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <script>
                        $(document).ready( function () {
                            $('#indexTable').DataTable();
                        } );
                    </script>


                </div>
            </div>
        </div>
    </div>

    @push('blueadmin_header')
        @include('BlueAdminLayout::dataTables')
    @endpush


</x-ba-admin-layout>

