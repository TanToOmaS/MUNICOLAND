<div class="row">
    <div class="col s4 m4">
        <div class="carousel carousel-slider center">
            <?php

            $queryEventos = "SELECT * FROM eventos ORDER BY FECHA ASC";
            $listaEventos = mysqli_query($conexion, $queryEventos);

            while ($fila = mysqli_fetch_assoc($listaEventos)) {

            ?>
                
                    <div class="carousel-fixed-item center">
                        <a class="btn waves-effect  teal lighten-2 white-text darken-text-2">ME PUNTO</a>
                    </div>
                    <div class="carousel-item white-text" href="#one!">
                        <h2><?php echo  $fila['EVENTO'] ?></h2>
                        <p class="white-text"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                        <img src="<?php echo  $fila['IMAGEN'] ?>">            
                    </div>                    

            <?php } ?>

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="jquery-3.4.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.carousel');
        var instances = M.Carousel.init(elems, {
            duration: 300,
            indicators: true,
            fullWidth: true
        });
    });
</script>