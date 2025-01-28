# Agenda de Contactos

Este proyecto es una **Agenda de Contactos** desarrollada con **PHP**, que utiliza **HTML, CSS y JavaScript** para la parte del front-end y **MariaDB** como base de datos. Permite **crear, leer, actualizar y eliminar** (CRUD) información de contactos (nombre, teléfono, email, etc.).

## Requisitos

- **Servidor Web** (por ejemplo, Apache o NGINX).
- **PHP** 7.4 o superior (recomendado 8+).
- **MariaDB** como gestor de base de datos.
- Extensión de **PDO** habilitada en PHP (generalmente viene por defecto, pero se debe verificar la configuración).

## Clonar el repositorio

```bash
git clone https://github.com/claudioborja/agenda.git
cd agenda
```

## Configuración de la base de datos

1. Dentro de la carpeta `db` del proyecto encontrarás un archivo llamado `agenda.sql`.
2. Importa este archivo en tu gestor de base de datos (como phpMyAdmin, DBeaver o la línea de comandos de MySQL/MariaDB).  
   Por ejemplo, desde la línea de comandos:
   ```bash
   mysql -u tu_usuario -p agenda < db/agenda_db.sql
   ```

## Configuración de la base de datos
- **Usuario Admin** (admin)
- **Clave Admin** (admin123)
