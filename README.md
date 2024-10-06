
# Intercorp

Plataforma de comercio en línea dedicada a la venta de laptops. Cuenta con

- Manejo de inventario de productos
- Sistema de gestión de órdenes
- Gestión de envíos
- Seguimiento de pedidos en tiempo real usando WebSockets

## Instalación

1. Clonar el repositorio

```bash
git clone
```

2. Instalar dependencias

```bash
composer install && npm i
```

3. Crear archivo de configuración de entorno

```bash
cp .env.example .env
```

4. Generar clave de aplicación

```bash
php artisan key:generate
```

5. Crear una base de datos MySQL y configurar credenciales en el archivo .env, así como una cuenta
   de [Pusher](https://pusher.com/).
6. Ejecutar migraciones

```bash
php artisan migrate
```

7. Iniciar servidor y Vite

```bash
php artisan serve
npm run dev
```

8. Acceder a la aplicación en http://localhost:8000
9. (Opcional) Generar información de prueba

```bash
php artisan db:seed
```

## Tecnologías

- ORM: Eloquent
- WebSockets: Laravel Echo, Pusher
- Frontend: Blade y TailwindCSS
- Base de datos: MySQL
- Autenticación: Laravel Passport

