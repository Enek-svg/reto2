# Permite crear, modificar y eliminar usuarios, y guardar el resultado en usuarios.txt.

# Lista con los nombres de todos los usuarios creados
usuarios = []
# Cada departamento es [nombre, usuario asignado, cargo]. "VACIO" = sin usuario
Departamentos = [
    ["SistemasIT", "VACIO", "Tecnico"],
    ["Desarollo", "VACIO", "Programador"],
    ["Redes", "VACIO", "Soporte"],
    ["Administracion", "VACIO", "Administrativo"]
]
# Bucle principal: muestra el menú hasta que el usuario elige salir
while True:
    print("========================")
    print("1. Crear Usuario")
    print("2. Modifiar Usuario")
    print("3. Eliminar Usuario")
    print("4. Mostrar Listas")
    print("5. Salir")
    print("========================")
    menu = int(input("Bienvenido a la terminal de usuarios, que desea hacer? (del 1 al 5): "))
    
    # OPCIÓN 1: crear un usuario y asignarlo a un departamento
    if menu == 1:
        new = input("Introduce el nombre del nuevo usuario: ")
        usuarios.append(new)
        print("========================")
        print("1. SistemasIT")
        print("2. Desarollo")
        print("3. Redes/soporte")
        print("4. Administracion")
        print("========================")
        dep = int(input("A que departamento desearias asignar este usuario? (DEL 1 AL 4, el cargo sera asginado automaticamente dependiendo de el departamento que se le asgine): "))
        if dep == 1:
            Departamentos[0][1] = new
            print("El usuario se ha agregado correctamente a este departamento.")
        elif dep == 2:
            Departamentos[1][1] = new
            print("El usuario se ha agregado correctamente a este departamento.")
        elif dep == 3:
            Departamentos[2][1] = new
            print("El usuario se ha agregado correctamente a este departamento.")
        elif dep == 4:
            Departamentos[3][1] = new
            print("El usuario se ha agregado correctamente a este departamento.")
        else:
            print("Error, intentalo de nuevo.")
        
    # OPCIÓN 2: modificar un usuario (cambiar nombre o intercambiar departamento)
    elif menu == 2:
        edit = input("Introduce el nombre del usuario a editar: ")
        if edit in usuarios:
            print("========================")
            print("1. Editar el nombre del usuario.")
            print("2. Cambiar este usuario por otro (Intercambiar departamentos).")
            print("========================")
            menu1 = int(input("Que quieres cambiar de este usuario? (DEL 1 AL 2): "))
            # Cambiar el nombre: se actualiza en la lista de usuarios y en el departamento
            if menu1 == 1:
                nuevo_nombre = input("Escribe el nuevo nombre para este usuario: ")

                for a in range(len(usuarios)):
                    if usuarios[a] == edit:
                        usuarios[a] = nuevo_nombre
                for b in Departamentos:
                    if b[1] == edit:
                        b[1] = nuevo_nombre
                        print("El nombre del usuario se ha cambiado correctamente.")

            # Intercambiar departamento: busca el departamento actual y lo cambia por el elegido
            elif menu1 == 2:
                dep_origen = -1
                for c in range(len(Departamentos)):
                    if Departamentos[c][1] == edit:
                        dep_origen = c
                        break
                
                print("========================")
                print("1. SistemasIT")
                print("2. Desarrollo")
                print("3. Redes")
                print("4. Administracion")
                print("========================")
                dep_destino = int(input("Con que departamento quieres intercambiarlo? (DEL 1 AL 4): ")) -1

                if dep_origen >= 0:
                    usuario_destino = Departamentos[dep_destino][1]
                    Departamentos[dep_destino][1] = edit
                    Departamentos[dep_origen][1] = usuario_destino
                    print("Los usuarios se han intercambiado de departamento correctamente.")
                else:
                    print("El usuario no esta asignado a ningun departamento.")

    # OPCIÓN 3: eliminar un usuario y dejar su departamento como VACIO
    elif menu == 3:
        old = input("Introduce el nombre del usuario a eliminar: ")

        if old in usuarios:
            usuarios.remove(old)
            for o in Departamentos:
                if o[1] == old:
                    o[1] = "VACIO"

            print("El usuario se ha eliminado correctamente de los usuarios y departamentos.")
        else:
            print("Este usuario no existe en la lista.")

    # OPCIÓN 4: mostrar los usuarios y el estado de cada departamento
    elif menu == 4:
        print("========================")
        print("Usuarios registrados:", usuarios)
        print("========================")
        print("ESTADOS DE LOS DEPARTAMENTOS:")
        print("===============================")
        
        for d in Departamentos:
            print(f"- Departamento: {d[0]} | Usuario: {d[1]} | Cargo: {d[2]}")
            print("========================")
    
    # OPCIÓN 5: guardar el estado de los departamentos en usuarios.txt y salir
    elif menu == 5:
        with open("usuarios.txt", "w", encoding="utf-8") as archivo:
            archivo.write("====LISTA-DE-DEPARTAMENTOS-Y-USUARIOS====\n")
            for d in Departamentos:
                linea = f"Departamento: {d[0]} | Usuario: {d[1]} | Cargo: {d[2]}\n"
                archivo.write(linea)

        print("Gracias por usar la terminal de usuarios.")
        break
    # Cualquier otra opción: aviso de error
    else:
        print("Opcion no valida, intentalo de nuevo.")