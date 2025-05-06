<x-app-layout title="Product">

    @section('hero')
       {{--  <header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-800">
          <div
              id='banner'
              tabIndex='-1'
              class='z-50 flex justify-center w-full px-4 py-3 border border-b border-gray-200 bg-gray-50 dark:border-gray-600 lg:py-4 dark:bg-gray-700'>
              <div class='items-center md:flex'>
                <p class='text-sm font-medium text-gray-900 md:my-0 dark:text-white'>
                  <span class='bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hidden md:inline'>New</span>
                  We have launched Flowbite Blocks featuring over 450+ website sections!
                    <a href="/blocks/" class='inline-flex items-center ml-2 text-sm font-medium text-blue-600 md:ml-2 dark:text-blue-500 hover:underline'>
                      Check it out
                      <svg class="w-3 h-3 ml-1.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                      </svg>
                    </a>
                </p>
              </div>
          </div>
        </header> --}}
    @endsection

    <div class="grid w-full grid-cols-4 gap-10">
        <div class="col-span-4 md:col-span-3">
            <livewire:product-list />
        </div>
        <div id="side-bar"
            class="sticky top-0 h-screen col-span-4 px-3 py-6 pt-10 space-y-10 border-t border-gray-100 border-t-gray-100 md:border-t-none md:col-span-1 md:px-6 md:border-l">
            @include('products.partials.search-box')

            @include('products.partials.categories-box')
        </div>
    </div>

</x-app-layout>
