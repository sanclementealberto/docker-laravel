#!/bin/bash

# Iniciar Apache en segundo plano
service apache2 start

# Iniciar SSH en primer plano
/usr/sbin/sshd -D
