# Copalina - Practica con PHP y MySQL

## Archivos

| Archivo | Para que sirve |
|---|---|
| index.html | Pagina principal |
| sesion.html | Formulario de inicio de sesion (muestra errores) |
| registro.html | Formulario de registro |
| estilos.css | Estilos de todas las paginas |
| conexion.php | Conexion a la base de datos |
| registrar.php | Guarda un usuario nuevo |
| login.php | Revisa email y contrasena |
| bienvenida.php | Pagina que solo se ve si iniciaste sesion |
| logout.php | Cierra la sesion |
| base_datos.sql | Crea la base de datos y la tabla |

## Como probarlo en tu computadora

1. Instala XAMPP (https://www.apachefriends.org) y enciende **Apache** y **MySQL** desde su panel.
2. Abre http://localhost/phpmyadmin, ve a la pestana **Importar** y sube `base_datos.sql`.
3. Copia todos los archivos de esta carpeta a `C:\xampp\htdocs\copalina\`.
4. Pon tu imagen `motoad.png` en esa misma carpeta.
5. Abre http://localhost/copalina/index.html en el navegador.

Si cambiaste la contrasena de MySQL, editala en `conexion.php`
(en XAMPP el usuario es `root` y la contrasena esta vacia por defecto).

## Importante

- Abre las paginas siempre con `http://localhost/...`, **no** haciendo doble clic en el archivo,
  porque asi PHP no se ejecuta.
- GitHub Pages no ejecuta PHP. Para publicarlo necesitas un hosting con PHP y MySQL.
- No subas a GitHub tu `conexion.php` con datos reales.
- Las contrasenas se guardan cifradas con `password_hash`, nunca en texto plano.
