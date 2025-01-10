# Laravel dockerizado

![laravel-docker](img/laravel-docker.png)

Este proyecto permite desplegar a traves de contenedores docker los servicios necesarios para desplegar una aplicación con Laravel.

---

## 1. Requisitos previos

- Tener instalados:
  - Docker
  - Docker Compose
  - Git
- Conexión a Internet para descargar las imágenes y dependencias.

---

## 2. Configuración de acceso SSH

Para que funcione correctamente la conexión SSH con el servicio app_laravel, crea una clave ssh.

```bash
ssh-keygen -t rsa -b 4096 -C "tu_correo@example.com"
```

Esto generará dos archivos:

   - ~/.ssh/id_rsa (clave privada)
   - ~/.ssh/id_rsa.pub (clave pública)

Y copia la pública id_rsa.pub a la raíz del proyecto.

```bash
cp ~/.ssh/id_rsa.pub ./id_rsa.pub
```

Es recomendable eliminarla una vez se haya copiado al contenedor, aunque esto implicaría volver a copiarla si se quisieran regenerar los servicios.

Para conectarnos desde el anfitrión, simplemente tendremo que hacerlo con ssh:

```bash
ssh -i ~/.ssh/id_rsa laravel@localhost -p 2222
```

En caso de regenerar los contenedores, es posible que detecte el cambio y por seguridad no nos deje conectar. Para solucionarlo, solo hay que borrar el host de los ya conocidos:

```bash
ssh-keygen -f '/home/ladmin/.ssh/known_hosts' -R '[localhost]:2222'
```

---

## 3. Construir y levantar los servicios

Ejecuta los siguientes comandos para construir y levantar los servicios:

```bash
docker compose build
docker compose up -d
```

Verifica que los contenedores están corriendo:

```bash
docker ps
```

---

## 4. Instalación de Laravel

### Creación de proyecto

1. Accede al contenedor de la aplicación:

```bash
ssh -i ~/.ssh/id_rsa laravel@localhost -p 2222
```

2. Instala Laravel usando Composer:

```bash
cd /var/www/html/
composer create-project --prefer-dist laravel/laravel . "^11.0"
```

No es necesario crear la base de datos SQLite. Editaremos la configuración más adelante.

### Configuración Apache y permisos

Accede al contenedor de la aplicación:

```bash
ssh -i ~/.ssh/id_rsa laravel@localhost -p 2222
```

Y edita el fichero `/etc/apache2/sites-available/000-default.conf` para que apunte a la carpeta pública de laravel.

```xml
<VirtualHost *:80>
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Sal del contenedor y renicia los servicios:

```bash
docker compose down
docker compose up -d
```

Establece los permisos adecuados:

```bash
sudo chmod -R 770 src
sudo chown -R www-data:$USER src
```

### Configuración de variables de entorno

La instalación cre un archivo `.env` en src. Debemos cambiar la configuración a nuestro gusto. Lo más importante es indicar la conexión con la base de datos.

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=devtest
```

### Finalizar la instalación

Para usar `php artisan`, accede al contenedor:

```bash
ssh -i ~/.ssh/id_rsa laravel@localhost -p 2222
```

Y ejecuta los siguientes pasos para finalizar la instalación:

```bash
php artisan migrate
php artisan key:generate
```

Accede a `http://localhost` para comprobar que puedes visualizar correctamente la página inicial de Laravel.
