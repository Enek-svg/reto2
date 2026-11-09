# Pide una longitud y crea una contraseña aleatoria con letras, números y símbolos.

import random
import string

print("=====GENERADOR=DE=CONTRASENAS=====")

# Longitud que elige el usuario
longitud = int(input("De cuantos caracteres quieres que sea la contrasena?: "))

# Conjunto de caracteres permitidos: letras, números y símbolos
caracteres = string.ascii_letters + string.digits + string.punctuation
contrasena = ""

# Se elige un carácter al azar tantas veces como longitud pida el usuario
for i in range(longitud):
    contrasena += random.choice(caracteres)

print(f"Tu contrasena segura es: {contrasena}")
