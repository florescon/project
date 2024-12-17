<x-app-layout>
    <div class="items-center w-10/12 grid-cols-2 mx-auto overflow-x-hidden lg:grid md:py-14 lg:py-24 xl:py-14 lg:mt-3 xl:mt-5" data-aos="fade-right" data-aos-duration="800">
      <div class="pr-2 md:mb-14 py-14 md:py-0">
        <h1 class="text-3xl font-semibold text-blue-900 xl:text-5xl lg:text-3xl"><span class="block w-full">{{ __('URL Data Removal Instructions') }}</span></h1>
        <p class="py-4 text-lg text-gray-500 2xl:py-8 md:py-6 2xl:pr-5">

En concordancia con las regulaciones de Facebook para Apps y sitios web, debemos brindarle a los usuarios las instrucciones para eliminar sus datos. Si quieres eliminar tu actividad relacionada a la App, lo puedes hacer de la siguiente manera.
<br><br>
1. Ingresa a tu cuenta de Facebook y haz clic en “Configuración y privacidad”. Después haz clic en “Configuración”.<br>
2. Ve a la sección de “Apps y sitios web”, aquí podrás ver toda tu actividad relacionada a aplicaciones y páginas web registradas en tu cuenta de Facebook.<br>
3. Selecciona la casilla correspondiente a la App y haz clic en “Eliminar”.<br>
4. Selecciona las casillas de acuerdo a tu preferencia y haz clic en “Eliminar”.<br>
5. ¡Listo! Eliminaste a la App de tus actividades de manera exitosa.<br>

        </p>
        <div class="mt-4">
          <a href="{{ url('/') }}" class="px-5 py-3 text-lg tracking-wider text-white bg-blue-500 rounded-lg md:px-8 hover:bg-blue-600 group"><span>{{ __('Home') }}</span> </a>
        </div>
      </div>

      <div class="pb-10 overflow-hidden md:p-10 lg:p-0 sm:pb-0">
        <img id="heroImg1" class="transition-all duration-300 ease-in-out hover:scale-105 lg:w-full sm:mx-auto sm:w-4/6 sm:pb-12 lg:pb-0" src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/hero-img.png" alt="Awesome hero page image" width="500" height="488"/>
      </div>
    </div>

</x-app-layout>
