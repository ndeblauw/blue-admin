<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            @if($rte && config('blue-admin.flux', false))
                <livewire:rte-editor name="{{ $name }}" content="{!! old($name, $value)  !!}" />
            @else
                <textarea
                    name="{{ $name }}"
                    id="{{ $id }}"
                    rows="{{ $rows }}"
                    placeholder="{!! $placeholder !!}"
                    class="{{ $rte ? $name.'_rte' : '' }} max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-lg sm:text-sm {{ $errors->first($name) ? 'border-red-300' : 'border-gray-300' }} rounded-md"
                    {{ $required ? 'required' : '' }}
                    {{$disabled}}
                >{!! old($name, $value)  !!}</textarea>
                @endif
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

@if($rte && !config('blue-admin.flux', false))

    @push('blueadmin_scripts')

        @if(config('blue-admin.ckeditor', true))
            <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('.{{$name}}_rte'),{
                        // Configure the toolbar with only the tools you need
                        toolbar: [
                            'bold', 'italic', 'underline', 'strikethrough',
                            'numberedList', 'bulletedList', 'outdent', 'indent',
                            'link', 'undo', 'redo'
                        ],
                        height: '450px'
                    }).then(editor => {
                        // Access the editable area
                        const editableElement = editor.ui.view.editable.element;

                    // Fix height with JavaScript
                    editableElement.style.height = '200px'; // Fixed height
                    editableElement.style.overflowY = 'auto'; // Scrollable on overflow
                })
                    .catch(error => {
                        console.error(error);
                    });
            </script>

        @else

            <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" integrity="sha512-RnlQJaTEHoOCt5dUTV0Oi0vOBMI9PjCU7m+VHoJ4xmhuUNcwnB5Iox1es+skLril1C3gHTLbeRepHs1RpSCLoQ==" crossorigin="anonymous"></script>

            <script>
                var editor_config_{{$name}} = {
                    relative_urls : false,
                    path_absolute: "{{ URL::to('/') }}/",
                    selector: '.{{$name}}_rte',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace ',
                        'paste help wordcount code'
                    ],
                    toolbar: ' undo redo | @if($h2h3) h2 h3 | @endif  bold italic | link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | removeformat | code | help',
                }
                tinymce.init(editor_config_{{$name}});
            </script>

        @endif
    @endpush
@endif
