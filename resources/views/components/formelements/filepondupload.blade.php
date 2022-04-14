<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            <span class="text-gray-400 ml-2 text-sm">
                You can upload {{ $multiple ? 'multiple files' : 'one single file'}} {{ ($maxFiles !== null) ? '(max '.$maxFiles.')' : '' }}
            </span>

            <input
                type="file"
                name="{{ $multiple ? $name.'[]' : $name}}"
                id="{{ $id }}"
                value="{{old($id, $value)}}"
                class="filepond {{ ($errors->first($name) ? 'is-invalid' : '') }}"
                {{ $multiple ? 'multiple' : '' }}
                {!! $multiple ? 'data-allow-reorder="true"' : '' !!}
            >
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

@push('blueadmin_header')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush

@push('blueadmin_scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        const inputElement = document.querySelector('.filepond');
        const pond = FilePond.create( inputElement, {
            onaddfilestart: (file) => { isLoadingCheck(); },
            onprocessfile: (files) => { isLoadingCheck(); }
        });
        FilePond.setOptions({
            @if($maxFiles !== null) maxFiles: {{$maxFiles}},@endif
            server: {
                url: '{{route('filepond.upload')}}',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
            },
            @if( isset($model) && ($model->getMedia($name) !== null) )
            files: [
                    @foreach($model->getMedia($name) as $existingFile)
                {
                    // the server file reference
                    source: 'existing_file_{{$existingFile->id}}',

                    // set type to local to indicate an already uploaded file
                    options: {
                        type: 'local',

                        // mock file information
                        file: {
                            name: '{{$existingFile->name}}',
                            size: {{$existingFile->size}},
                            type: '{{$existingFile->mime_type}}'
                        }
                    }
                },
                @endforeach
            ],
            @endif
        });
        
        function isLoadingCheck(){
            var isLoading = pond.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                document.getElementById('formButton').disabled = true;
                document.getElementById('formButtonHelpText').style.visibility = "visible";
            } else {
                document.getElementById('formButton').disabled = false;
                document.getElementById('formButtonHelpText').style.visibility = "hidden";
            }
        }

    </script>
@endpush
