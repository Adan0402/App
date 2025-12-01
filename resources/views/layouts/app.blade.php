<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bolsa Trabajo ITSZN')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- ✅ BIBLIOTECAS NECESARIAS PARA NOTIFICACIONES -->
    <!-- jQuery - ESENCIAL para que funcionen las notificaciones -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome - Para íconos bonitos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tus estilos personalizados si los tienes -->
    <style>
        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }
        
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Aquí se insertará el contenido de cada página -->
    @yield('content')
    
    <!-- ✅ AGREGAR AXIOS (FALTABA) -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <!-- Aquí se insertarán scripts específicos de cada página -->
    @stack('scripts')
</body>
</html>