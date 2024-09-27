from unidecode import unidecode

# Leer el archivo con acentos
with open('colonias/coordenadas.txt', 'r', encoding='utf-8') as colonias:
    contenido = colonias.read()

# Convertir el texto quitando acentos
colonias_sin_acentos = unidecode(contenido).split('\n')

valores = []
num = 2
for i in colonias_sin_acentos:
    if ('Latitud' in i) and ('Longitud' in i):
        # Extraer el nombre de la colonia, latitud y longitud
        partes = i.split()
        nombre_colonia = ' '.join(partes[:-4])
        lat_index = partes.index('Latitud') + 1
        lng_index = partes.index('Longitud') + 1
        lat_part = partes[lat_index]
        lng_part = partes[lng_index]

        # print(f'<option value="{num}">{nombre_colonia}</option>')
        # num+=1
        
        # Añadir el valor a la lista
        valores.append(f"('{nombre_colonia}', {lat_part}, {lng_part})")
        
# Crear la sentencia SQL
if valores:
    sql = f"INSERT INTO coordenadas (nombre_colonia, latitud, longitud) VALUES\n" + ",\n".join(valores) + ";"
    print(sql)