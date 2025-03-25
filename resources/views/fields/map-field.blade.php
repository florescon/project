<div>
    {{-- <div id="map" style="height: 400px; width: 100%;"></div> --}}
    {{-- <p id="map-error" style="color: red; display: none;">No se pudo cargar el mapa.</p> --}}
    <a href="{{ $getHref() }}" target="_blank" style="color: blue; text-decoration: underline;">
        Ver en Google Maps
    </a>


</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const address = "{{ $getState }}";
        const mapElement = document.getElementById('map');
        const errorElement = document.getElementById('map-error');

        if (address === 'Dirección no disponible') {
            mapElement.style.display = 'none';
            errorElement.style.display = 'block';
            errorElement.innerText = 'Dirección no disponible';
            return;
        }

        // Usar un servicio de geocodificación para convertir la dirección en coordenadas
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = data[0].lat;
                    const lon = data[0].lon;

                    // Inicializar el mapa
                    const map = L.map('map').setView([lat, lon], 13);

                    // Añadir capa de tiles (puedes usar OpenStreetMap o otros proveedores)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    // Añadir un marcador en la ubicación
                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(address)
                        .openPopup();
                } else {
                    mapElement.style.display = 'none';
                    errorElement.style.display = 'block';
                    errorElement.innerText = 'No se pudo geocodificar la dirección';
                }
            })
            .catch(error => {
                console.error('Error al geocodificar la dirección:', error);
                mapElement.style.display = 'none';
                errorElement.style.display = 'block';
                errorElement.innerText = 'Error al cargar el mapa';
            });
    });
</script> --}}