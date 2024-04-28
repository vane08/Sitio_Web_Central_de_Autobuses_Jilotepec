<?php
#LUGAR DONDE SE UBICARA LA IMAGEN
$dir_subida = '../img/';
#
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
#MUESTRA LOS DATOS DE MANERA MAS ORDENADA
echo '<pre>';
#SI LA CONDICION ES CORRECTA, LOS DATOS SE ALMACENAN EN LA VARIABLES, ESTA CONTIENE TODA LA INFORMACION.
#SI FUNCIONO CON EXITO, SE MUESTRA QUE SI FUNCIONO.
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
#SI SUPERA EL TAMAÑO MAXIMO, SE MOSTRARÁ ESTE ERROR
    echo "¡Posible ataque de subida de ficheros!\n";
}
#SE MUESTRA LA INFORMACION DEL MOVIMIENTO
echo 'Más información de depuración:';
print_r($_FILES);

print "</pre>";

echo $fichero_subido;?>