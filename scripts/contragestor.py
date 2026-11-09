import random
import string

print("=====GENERADOR=DE=CONTRASENAS=====")
longitud = int(input("De cuantos caracteres quieres que sea la contrasena?: "))

caracteres = string.ascii_letters + string.digits + string.punctuation
contrasena = ""

for i in range(longitud):
    contrasena += random.choice(caracteres)

print(f"Tu contrasena segura es: {contrasena}")