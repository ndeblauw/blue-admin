<x-ba-admin-layout title="{{$config->name_to_use}}" :showTitle="false">

    <style>
        #{{$config->modelsname()}}-table_filter input[type="search"] {
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

                    <table class="min-w-full divide-y divide-gray-200" id="{{$config->modelsname()}}-table">
                        <thead class="bg-gray-50">
                        <tr>
                            @foreach($config->getIndexTableColumns() as $column)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $column === 'title' ? $config->titleField() : $column }}
                                </th>
                            @endforeach
                            <th scope="col" class="relative px-6 py-3">
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('blueadmin_header')
        @include('BlueAdminLayout::dataTables')
    @endpush


    @push('blueadmin_scripts')
        <script>

            $(function() {
                $('#{{$config->modelsname()}}-table').DataTable({
                    stateSave: {{Session::has('blueadmin-'.$config->modelsname() . '-index-statesave') ? 'true' : 'false'}},
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('blueadmin.api.index', $config->modelsname()) !!}',
                    columns: [
                        @foreach($config->getIndexTableColumns() as $column)
                            {data: '{{$column}}',},
                        @endforeach
                    ],
                    columnDefs: [
                        { targets: {{$actions_col_nr}},
                            render: function(data, type, row) {

                                actionfield = '';

                                actionfield = actionfield + '<a href="{{route("admin.{$config->modelsname()}.index") }}/' + row['id'] + '" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>'

                                @if(!View::exists("admin.{config->modelsname()}._form"))
                                    actionfield = actionfield + '<a href="{{ route("admin.{$config->modelsname()}.index") }}/' + row['id'] + '/edit" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>'
                                @endif

                                @if( Session::has("blueadmin-{$config->modelsname()}-index-show-delete") )
                                    actionfield = actionfield + '<form class="inline" method="POST" action="{{ route("admin.{$config->modelsname()}.index") }}/' + row['id'] + '"> @method('DELETE') @csrf <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-4">Delete</button></form></span>&nbsp;'
                                @endif

                                return actionfield
                            }
                        },

                        { targets: [{{$actions_col_nr}}],
                            searchable: false
                        }
                    ]
                });
            });


        </script>
    @endpush


</x-ba-admin-layout>

