<footer class="py-12 bg-gray-50 xl:pt-24 dark:bg-gray-800">
    <div class="w-full px-4 mx-auto max-w-8xl">
        <div class="grid gap-12 xl:grid-cols-6 xl:gap-24">
            <div class="col-span-2">
                <a href="{{ url('/') }}" class="flex mb-5">
                    <img src="{{ asset('/images/francos.png') }}" class="h-16 mr-3" alt="Flowbite Logo" />
                </a>
                <p class="max-w-lg mb-3 text-gray-600 dark:text-gray-400 ml-3">Restaurante.</p>
 
                @foreach (config('app.supported_locales') as $locale => $data)
                <a href="{{ route('locale', $locale) }}">
                    <x-dynamic-component :component="'flag-country-' . $data['icon']" class="ml-3 w-6 h-6" />
                </a>
                @endforeach

            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-400 uppercase dark:text-white">@lang('Resources')</h3>
                <ul>
                    <li class="mb-4">
                        <a href="#"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('Documentation')
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('my-orders.index') }}"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('My Orders')
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-400 uppercase dark:text-white">@lang('Help and support')</h3>
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('deletion') }}" rel="noreferrer nofollow"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('Contact us')</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('deletion') }}" rel="noreferrer nofollow"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('URL Data Removal Instructions')
                        <span class='bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-2'>
                        New
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-400 uppercase dark:text-white">@lang('Follow us')</h3>
                <ul>
                    <li class="mb-4">
                        <a href="https://facebook.com" target="_blank" rel="noreferrer nofollow"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">Facebook</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://instagram.com" target="_blank" 
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">Instagram</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-400 uppercase dark:text-white">@lang('Legal')</h3>
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('policy.show') }}/"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('Privacy Policy')</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('terms.show') }}"
                            class="font-medium text-gray-600 dark:text-gray-400 dark:hover:text-white hover:underline">@lang('Terms & Conditions')</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-8 border-gray-200 dark:border-gray-700 lg:my-12" />
        <span class="block text-center text-gray-600 dark:text-gray-400 font-">© {{ now()->year }}-<span id="currentYear"></span> <a href="{{ url('/') }}"> Francos. </a> All Rights Reserved.
        </span>
    </div>
</footer>