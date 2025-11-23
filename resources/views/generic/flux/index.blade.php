<x-ba-admin-layout title="{{$config->name_to_use}}" :showTitle="false">

    <style>
        #indexTable_filter input[type="search"] {
            background-color: rgb(241 245 249) !important;
            border-radius: 5px;
        }
    </style>

    <flux:heading size="xl" level="1" class="flex justify-between items-center mb-2">
        <div>{{$config->name_to_use}}</div>
        @if( View::exists('admin.'.$config->modelsname().'._form'))
            <flux:button href="{{$config->getCreateUrl()}}" icon="plus" variant="filled" size="sm">{{__('Create New')}}</flux:button>
        @endif
    </flux:heading>

    <flux:separator />

    @includeWhen(view()->exists(($view = 'admin.'.$config->modelsname().'._index_top')), $view)

    <div class="flex flex-col mt-2">
        <div class="">
            <div class="">
                <div class="overflow-hidden">

                    <table class="min-w-full divide-y divide-gray-200" id="indexTable">
                        <thead class="bg-gray-50">
                        <tr>
                            @foreach($config->getIndexTableColumns() as $column)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $column === 'title' ? $config->titleField() : $column }}
                                </th>
                            @endforeach
                            <th scope="col" class="relative px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($models as $model)
                            <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif hover:bg-gray-100">
                                @foreach($config->getIndexTableColumns() as $column)
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                        @if($column === 'title')
                                            @php $titlefield = $config->titleField() @endphp
                                            {{$model->$titlefield}}
                                        @else
                                            @if(is_bool($model->$column))
                                                {{ $model->$column ? 'Yes' : 'No' }}
                                            @else
                                                {{data_get($model, $column)}}
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{$config->getShowUrl($model->getKey())}}" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>
                                    @if( View::exists('admin.'.$config->modelsname().'._form'))
                                        <a href="{{$config->getEditUrl($model->getKey())}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    @endif
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

    @includeWhen(view()->exists(($view = 'admin.'.$config->modelsname().'._index_bottom')), $view)


@push('blueadmin_header')
    @include('BlueAdminLayout::dataTables')
@endpush

</x-ba-admin-layout>

