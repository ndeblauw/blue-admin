<x-ba-admin-layout title="Edit {{$config->name_to_use}} {{$model->id}}" :titleShow="false">

    @if($errors->count() > 0) @ray($errors) @endif

    <form role="form" action="{{ $config->getUpdateUrl($model->getKey()) }}" method="POST" enctype="multipart/form-data" class="mt-4">

        @csrf
        @method('PUT')

        <div class="border border-zinc-200 rounded-lg">

            <div class="px-4 pb-4">
                @bind($model ?? null)
                @includeFirst([$config->pathforAdminViews() .'._form', 'BlueAdminGeneric::_form_not_found'], ['ba_form_create' => false])
                @endbind
            </div>

            <div class="p-4 flex justify-end border-t-2 border-zinc-200 bg-zinc-200 rounded-b-lg">
                <span id="formButtonHelpText" style="visibility: hidden;" class="text-sm px-4 mr-4 py-2 text-yellow-700">Please wait until the file upload is ready to save...</span>

                <flux:button href="{{$config->getBackOrIndexUrl()}}" type="submit" id="formButton" variant="ghost">Cancel</flux:button>&nbsp;&nbsp;
                <flux:button type="submit" id="formButton">UPDATE</flux:button>
            </div>

        </div>

    </form>

</x-ba-admin-layout>