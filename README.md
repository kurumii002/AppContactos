# Requisitos:
1. Tener PHP instalado
2. Tener MySQL
3. Un servidor apache (preferible usar XAMPP)
4. Tener Composer y Node.js

# Instalación:
1. Clonar el proyecto (`git clone`) en una carpeta e ir a la carpeta
2. Instalar las dependencias de Composer `composer install`
3. Instalar las dependencias de NPM `npm install`
4. Localizar el archivo **.env.example** y quitarle la extension *.example*
5. Generar el APP Key con `php artisan key:generate`
6. Crear una base de datos para la app 
7. Rellenar los párametros de configuración en el archivo **.env** (colocar el host, puerto, nombre de la BD, usuario y contraseña)
8. Hacer la mirgración de la DB con `php artisan migrate`
9. Ejecutar la app con `php artisan serve` y visitar el link que retorna por consola