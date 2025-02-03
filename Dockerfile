FROM php:8.2.23-apache

ARG DEBIAN_FRONTEND=noninteractive

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    nano \
    sudo

# Include  DB driver
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

# Configurar permisos carpeta web
RUN chown www-data:www-data /var/www/html

RUN a2enmod rewrite
RUN a2enmod ssl
#&& apache2-foreground && service apache2 restart

# Instalar Xdebug
RUN pecl install xdebug-3.3.2
RUN docker-php-ext-enable xdebug

ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Configurar ServerName para Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copiar certificados SSL
COPY certs/apache-selfsigned.crt /etc/ssl/certs/
COPY certs/apache-selfsigned.key /etc/ssl/private/

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar OpenSSH Server
RUN apt-get install -y openssh-server && \
    mkdir /var/run/sshd

# Crear usuario no root para SSH
RUN useradd -ms /bin/bash laravel && echo "laravel:devTest-.," | tee /etc/alternatives/passwd | chpasswd

# Añadir el usuario 'laravel' al grupo 'sudo' y a www-data
RUN usermod -aG sudo,www-data laravel

# Habilitar acceso con clave pública para el usuario laravel
RUN mkdir -p /home/laravel/.ssh && \
    chmod 700 /home/laravel/.ssh && \
    chown -R laravel:laravel /home/laravel/.ssh

# Copiar la clave pública al contenedor
COPY id_rsa.pub /home/laravel/.ssh/authorized_keys
RUN chmod 600 /home/laravel/.ssh/authorized_keys && \
    chown laravel:laravel /home/laravel/.ssh/authorized_keys

# Configuración de SSH
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config && \
    echo "AllowUsers laravel" >> /etc/ssh/sshd_config

# Exponer el puerto SSH
EXPOSE 22

# Crear script para iniciar servicios
RUN echo '#!/bin/bash\n' > /usr/local/bin/start.sh && \
    echo 'service apache2 start\n' >> /usr/local/bin/start.sh && \
    echo '/usr/sbin/sshd -D' >> /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

# Cambiar el comando de inicio para ejecutar el script
CMD ["/usr/local/bin/start.sh"]

WORKDIR /var/www/html