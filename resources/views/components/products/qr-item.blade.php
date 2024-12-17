@props(['product'])

<button class="bg-slate-500 text-white rounded-md px-4 py-2 hover:bg-slate-700 transition" onclick="openModal('modelQR')">
    <svg class="h-8 w-8 text-white-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="6" height="6" rx="1" />  <line x1="7" y1="17" x2="7" y2="17.01" />  <rect x="14" y="4" width="6" height="6" rx="1" />  <line x1="7" y1="7" x2="7" y2="7.01" />  <rect x="4" y="14" width="6" height="6" rx="1" />  <line x1="17" y1="7" x2="17" y2="7.01" />  <line x1="14" y1="14" x2="17" y2="14" />  <line x1="20" y1="14" x2="20" y2="14.01" />  <line x1="14" y1="14" x2="14" y2="17" />  <line x1="14" y1="20" x2="17" y2="20" />  <line x1="17" y1="17" x2="20" y2="17" />  <line x1="20" y1="17" x2="20" y2="20" /></svg>
</button>

<div id="modelQR" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('modelQR')" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 pt-0 text-center">

            <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6"> {{ $product->name }}</h3>

            <a class="inline-flex items-center  mb-4">
               {!! QrCode::size(100)->generate(route('products.show', $product->slug)); !!} 
            </a>

            <br>

            <a href="{{ route('products.qr', $product->slug) }}" target="_blank" 
                class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                Descargar
            </a>
            <a href="#" onclick="closeModal('modelQR')"
                class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"
                data-modal-toggle="delete-user-modal">
                Cerrar
            </a>
        </div>

    </div>
</div>

<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>
