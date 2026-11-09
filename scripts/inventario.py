equipos = []
while True:
    info = input("Pon la informacion de tu dispositivo (con esta estructura= /PC: /IP: /ISO: ) (escribe BORRAR para borrar un equipo, o EXIT para salir): ")
    if info == "EXIT":
        print("Gracias por usar el servicio de inventario.")
        with open("equipos.txt", "w", encoding="utf-8") as archivo:
            archivo.write("====LISTA=DE=EQUIPOS====\n")
            for a in equipos:
                linea = f"{a}\n"
                archivo.write(linea)
        break

    elif info == "BORRAR":
        if len(equipos) == 0:
            print("No hay equipos todavia.")
        else:
            print("\n====LISTA=DE=EQUIPOS=ACTUALES====")
            for i, a in enumerate(equipos):
                print(f"[{i}] {a}")
                
            delt = int(input("Escribe la posicion (numero) del equipo que quieres borrar: "))
            if 0 <= delt < len(equipos):
                eliminado = equipos.pop(delt)
                print("El equipo seleccionado se ha borrado correctamente.")
            else:
                print("Esa posicion no existe o no esta asignada a nada.")
    else:
        equipos.append(info)
        print("\n====EQUIPOS=ACTUALIZADOS====")
        for i, a in enumerate(equipos):
            print(f"[{i}] {a}")
        print("=" * 30)