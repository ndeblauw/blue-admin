<nav class="bg-white border-b border-gray-200 flex" aria-label="Breadcrumb">

    <ol class="max-w-screen-xl w-full  px-4 flex space-x-4 sm:px-6 lg:px-8">
        <li class="flex">
            <div class="flex items-center">
                <a href="/" class="text-gray-400 hover:text-gray-500">
                    <i class="fad fa-home fa-lg fa-fw group-hover:text-gray-500 mr-3"></i>
                    <span class="sr-only">Home</span>
                </a>
            </div>
        </li>
        @foreach($trail as $item)
            <li class="flex">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    @if(!$loop->last )
                        <a href="/{{$item->url}}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{$item->title}}</a>
                    @else
                        <a class="ml-4 text-sm font-medium text-gray-700 font-semibold">{{$item->title}}</a>
                    @endif
                </div>
            </li>
        @endforeach

    </ol>
</nav>
