# Pokedex Web App

Esta es una aplicación web simple basada en PHP y Bootstrap que permite a los entrenadores Pokémon gestionar sus Pokémon y objetos favoritos.

## Características

- Visualización de Pokémon desde la PokeAPI.
- Adición y eliminación de Pokémon a la lista de favoritos.
- Visualización de detalles de Pokémon y objetos.
- Gestión de objetos favoritos.

## Requisitos

- Servidor web (p. ej., Apache o Nginx).
- PHP 7.0 o superior.
- MySQL o base de datos compatible.

## Instalación

1. Clona este repositorio en tu servidor web:

   ```bash
   git clone https://github.com/tuusuario/pokedex.git
   ```


2. Configura la base de datos: importa el archivo SQL proporcionado en la carpeta `main/` y ajusta las credenciales de conexión en `config/db.php`.
3. Asegúrate de que las extensiones necesarias de PHP estén habilitadas (p. ej., `mysqli` para MySQL).
4. Accede a la aplicación desde tu navegador.

## Estructura del Proyecto

* **/acciones:** Scripts PHP para realizar acciones específicas (guardar Pokémon, objetos favoritos, etc.).
* **/config:** Archivos de configuración (conexión a la base de datos, etc.).
* **/controllers:** Controladores PHP para manejar la lógica de la aplicación.
* **/Model:** Modelos PHP para interactuar con la base de datos.
* **/main:** Páginas principales y vistas de la aplicación.
* **/vendor:** Bibliotecas de terceros (p. ej., Bootstrap, jQuery).
