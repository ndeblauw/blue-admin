<div id="sidebar" class="flex flex-col border-r border-gray-200 pb-0 bg-white overflow-y-auto w-1/6">

    <div class="mt-5 flex-grow flex flex-col">

        <nav class="flex-1 px-2 space-y-1 bg-white" aria-label="Sidebar">

            @foreach($menu as $item)
                
                {{-- Headers --}}
                @if(property_exists($item,'header'))
                    <div class="text-xs uppercase text-gray-400 font-bold ml-2 pt-4 ">
                        {{$item->header}}
                    </div>

                    @continue
                @endif

                {{-- Links without submenu --}}
                @if(!property_exists($item,'submenu'))
                    <div>
                        @if(property_exists($item,'active'))
                            <a href="/{{$item->link}}" class="bg-blue-50 font-bold text-gray-900 group w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md">
                                <i class="far {{$item->icon}} fa-lg fa-fw text-blue-200 mr-3"></i>
                                {{$item->title}}
                            </a>
                        @else
                            <a href="/{{$item->link}}" class="bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 group w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md">
                                <i class="fal {{$item->icon}} fa-lg fa-fw text-gray-400 group-hover:text-gray-500 mr-3"></i>
                                {{$item->title}}
                            </a>
                        @endif
                    </div>
                @endif

                {{-- Links wit submenu --}}
                @if(property_exists($item,'submenu'))
                    <div x-data="{isExpanded: {{ ($open = property_exists($item,'open')) ? 'true' : 'false' }}}" class="">

                        <button class="z-20 group w-full flex items-center mt-2 pl-2 pr-1 py-2 text-sm font-medium rounded-md bg-white {{ $open ? 'text-gray-900 bg-blue-50 font-bold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} focus:outline-none focus:ring-2 focus:ring-blue-500" @click.prevent="isExpanded = !isExpanded" x-bind:aria-expanded="isExpanded" >
                            <i class="{{$item->icon}} fa-lg fa-fw {{ $open ? 'far text-blue-200' : 'fal text-gray-400'}} group-hover:text-gray-500 mr-3"></i>
                            {{$item->title}}
                            <svg :class="{ 'text-gray-400 rotate-90': isExpanded, 'text-gray-300': !isExpanded }" x-state:on="Expanded" x-state:off="Collapsed"
                                 class="ml-auto h-5 w-5 transform group-hover:text-gray-400 transition ease-in-out duration-300 text-gray-300" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M6 6L14 10L6 14V6Z" fill="currentColor"></path>
                            </svg>
                        </button>

                        <div
                            x-show="isExpanded" class="space-y-1 ml-8 {{ $open ? 'border-l-4 border-blue-50' : 'mt-2'}}"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 transform scale-50"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-50"
                        >
                            @foreach($item->submenu as $subitem)
                                @if(property_exists($subitem,'active'))
                                    <a href="/{{$subitem->link}}" class="group flex items-center pl-3 pr-2 py-2 text-sm font-semibold bg-gray-100 text-gray-900 rounded-r-md">
                                        {!! $subitem->title !!}
                                    </a>
                                @else
                                    <a href="/{{$subitem->link}}" class="group w-full flex items-center pl-3 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                        {!! $subitem->title !!}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </nav>


    </div>

    <div class="flex-shrink-0 flex border-t border-gray-200 bg-gray-50 p-4 hover:bg-blue-50">
        <div href="#" class="flex-shrink-0 w-full group block">
            <div class="flex items-center">
                <div>
                    <i class="fal fa-2x text-gray-300 fa-user-circle"></i>

                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="">
                        <form class="float-right" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-xs text-gray-500 font-medium hover:text-blue-400" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log out') }}
                            </button>
                        </form>
                        <a href="#" class="text-xs font-medium text-gray-500 hover:text-blue-400">Your settings</a>&nbsp;<span class="text-blue-200">|</span>&nbsp;
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
