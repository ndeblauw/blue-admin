<x-ba-admin-layout>

    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-t-2 border-{{$config->color ?? 'blue-200'}} sm:rounded-b-lg">

                    <div class="bg-gray-50 px-6 flex justify-between">
                        <div class="text-left font-bold text-gray-500 uppercase tracking-wider py-5 ">
                            {{$config->name_to_use}}
                        </div>
                        <div class="my-auto text-sm font-medium flex gap-x-4">
                            <div class="uppercase text-xs my-auto flex gap-x-4">
                                @if( Session::has("blueadmin-{$config->modelsname()}-index-statesave") )
                                    <a href="{{route('blueadmin.index.toggle-statesave', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-on text-green-500"></i>&nbsp;state save</a>
                                @else
                                    <a href="{{route('blueadmin.index.toggle-statesave', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-off text-gray-400"></i>&nbsp;state save</a>
                                @endif

                                @if( Session::has("blueadmin-{$config->modelsname()}-index-show-delete") )
                                    <a href="{{route('blueadmin.index.toggle-show-delete', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-on text-green-500"></i>&nbsp;show delete</a>
                                @else
                                    <a href="{{route('blueadmin.index.toggle-show-delete', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-off text-gray-400"></i>&nbsp;show delete</a>
                                @endif

                                @if( Session::has("blueadmin-{$config->modelsname()}-open-new-window") )
                                    <a href="{{route('blueadmin.index.toggle-open-new-window', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-on text-green-500"></i>&nbsp;open actions in new window</a>&nbsp;&nbsp;&nbsp;
                                    @php $target = ' target=_blank '; @endphp
                                @else
                                    <a href="{{route('blueadmin.index.toggle-open-new-window', ['modelname' => $config->modelsname()])}}" class="my-auto"><i class="fas fa-toggle-off text-gray-400"></i>&nbsp;open actions in new window</a>&nbsp;&nbsp;&nbsp;
                                    @php $target = ' '; @endphp
                                @endif
                            </div>

                            @if( View::exists('admin.'.$config->modelsname().'._form'))
                                <x-ba-admin-button href="{{$config->getCreateUrl()}}" class="py-1 bg-green-500 text-xs my-auto">
                                    {{__('Create New')}}
                                </x-ba-admin-button>
                            @endif
                        </div>
                    </div>

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

                                actionfield = actionfield + '<a {{$target}} href="{{route("admin.{$config->modelsname()}.index") }}/' + row['id'] + '" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>'

                                @if(!View::exists("admin.{config->modelsname()}._form"))
                                    actionfield = actionfield + '<a {{$target}} href="{{ route("admin.{$config->modelsname()}.index") }}/' + row['id'] + '/edit" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>'
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

