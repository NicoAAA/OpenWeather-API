<!-- resources/views/weather/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Clima</title>
    <!-- Agregar Bootstrap y estilos personalizados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="weather-container">
        <h1 class="mb-4">Buscar Clima</h1>
        
        <!-- Formulario para latitud y longitud -->
        <form action="{{ route('weather.fetch') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="lat" class="form-label">Latitud</label>
                <input type="text" name="lat" id="lat" class="form-control" placeholder="Ej: -34.6037" required>
            </div>
            <div class="mb-3">
                <label for="lon" class="form-label">Longitud</label>
                <input type="text" name="lon" id="lon" class="form-control" placeholder="Ej: -58.3816" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar Clima</button>
        </form>

        <!-- Mostrar resultados si existen -->
        @if(isset($data))
            <div class="weather-results">
                <h2>Clima en {{ $data['name'] }}</h2>
                
                <!-- Icono SVG de clima -->
                <div class="weather-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a9 9 0 100 18 9 9 0 000-18z" />
                    </svg>
                </div>
                
                <p class="temperature">{{ round($data['main']['temp'] - 273.15, 1) }} °C</p>
                <p class="description">{{ $data['weather'][0]['description'] }}</p>
                <p>Humedad: {{ $data['main']['humidity'] }}%</p>
                <p>Viento: {{ $data['wind']['speed'] }} m/s</p>
            </div>
        @endif
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



