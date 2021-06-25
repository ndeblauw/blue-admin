<x-ba-admin-layout>

    @ray($errors)

    <form role="form" action="{{ $config->getStoreUrl() }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="bg-white shadow sm:rounded-b-lg border-t-2 border-blue-500">

            {{-- Card Top Header --}}
            <div class="px-4 py-5 sm:px-4 flex justify-between bg-gray-50">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fad fa-plus-square text-gray-400"></i>&nbsp;Create new <span class="font-semibold">{{$config->name_to_use}}</span>
                    </h3>
                </div>
                <div class="my-auto">
                    <span class="text-sm">Fields with <span class="text-blue-500">*</span> are required</span>
                </div>
            </div>

            <div class="px-6 pb-4 flex flex-col gap-y-2">
                @includeFirst([$config->pathforAdminViews() .'._form', 'BlueAdminGeneric::_form_not_found'], ['ba_form_create' => true])
            </div>

            <div class="p-4 flex justify-end border-t-2 border-gray-100">
                <x-ba-admin-button href="{{$config->getBackOrIndexUrl()}}" class="py-1 bg-blue-300">Cancel</x-ba-admin-button>&nbsp;&nbsp;
                <x-button type="submit" class="bg-blue-500 shadow" >Create</x-button>
            </div>

        </div>

    </form>






</x-ba-admin-layout>
