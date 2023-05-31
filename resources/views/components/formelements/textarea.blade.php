<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            <textarea
                name="{{ $name }}"
                id="{{ $id }}"
                rows="{{ $rows }}"
                placeholder="{!! $placeholder !!}"
                class="{{ $rte ? 'tinymce' : '' }} max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-lg sm:text-sm {{ $errors->first($name) ? 'border-red-300' : 'border-gray-300' }} rounded-md"
                {{ $required ? 'required' : '' }}
                {{$disabled}}
            >{{ old($name, $value) }}</textarea>
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

@if($rte)
    @push('blueadmin_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" integrity="sha512-RnlQJaTEHoOCt5dUTV0Oi0vOBMI9PjCU7m+VHoJ4xmhuUNcwnB5Iox1es+skLril1C3gHTLbeRepHs1RpSCLoQ==" crossorigin="anonymous"></script>
        <script>
            var editor_config = {
                relative_urls : false,
                path_absolute: "{{ URL::to('/') }}/",
                selector: '.tinymce',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks fullscreen',
                    'contextmenu paste help wordcount code'
                ],
                toolbar: ' undo redo | @if($h2h3) h2 h3 | @endif  bold italic | link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | removeformat | code | help',
            }
            tinymce.init(editor_config);
        </script>
    @endpush
@endif
