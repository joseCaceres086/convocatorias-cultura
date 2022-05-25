<?php

function print_calls_list() {
    $call_list = array();
    $response = file_get_contents('https://www.cultura.gob.ar/api/v2.0/convocatorias/?abierta=true&fecha_fin=&fecha_inicio=&format=json');

    if ( $response ) {
        $call_list = json_decode( $response, true);

        foreach ($call_list['results'] as $call) { 
            ?>
            <article>
                <h3><?php echo $call['titulo']?></h3>
                <h4><?php echo $call['bajada']?></h4>
                <p><?php echo $call['cuerpo']?></p>
                <p>Link: <a href="<?php echo $call['link']?>" target="_blank"><?php echo $call['link']?></a></p>
                <?php
                if ( ! empty( $call['imagen'] ) ) { ?>
                    <img src="<?php echo $call['imagen'];?>">
                    <?php }
                ?>
                <p>Fecha de Inicio: <?php echo $call['fecha_inicio']?></p>
                <p>Fecha de Cierre: <?php echo $call['fecha_fin']?></p>
                <h3><?php echo $call['titulo']?></h3>
            </article>
            <?php
        }

    }

    return $call_list;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizador de Convocatorias Culturales</title>
    <link rel="stylesheet" href="style.min.css">
</head>

<body>
    <main>
        <h1>Visualizador de Convocatorias del Ministerio de Cultura de la Nación Argentina</h1>
        <p>El siguiente listado es obtenido a partir de la API del Ministerio de Cultura 
        (<a href="https://www.cultura.gob.ar/api/">www.cultura.gob.ar/api/</a>)</p>
        
        <section id="call-list">
            <h2>Listado de Convocatorias Abiertas</h2>
            <?php print_calls_list(); ?>
        </section>
    </main>
</body>

</html>