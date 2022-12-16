<?php
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
$urlPart = explode("/", $url);
?>
<nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
        <!-- <li><a class="nav-link scrollto active" href="./">Ínicio</a></li> -->

        <li><a <?php if ($urlPart[2] == '') : ?> class="nav-link scrollto active" <?php else : ?> class="nav-link scrollto text-body" <?php endif; ?> href="./">Ínicio</a></li>
        <li><a <?php if ($urlPart[2] == 'conocenos.php') : ?> class="nav-link scrollto text-body active" <?php else : ?> class="nav-link scrollto" <?php endif; ?> href="#about">Conócenos</a></li>
        <li><a <?php if ($urlPart[2] == 'responsabilidadsocial.php') : ?> class="nav-link scrollto text-body active" <?php else : ?> class="nav-link scrollto" <?php endif; ?> href="#">Responsabildad Social</a></li>
        <li><a <?php if ($urlPart[2] == 'noticias.php') : ?> class="nav-link scrollto text-body active" <?php else : ?> class="nav-link scrollto" <?php endif; ?> href="./noticias.php">Noticias</a></li>
        <li><a <?php if ($urlPart[2] == 'trabajconnosotros.php') : ?> class="nav-link scrollto active" <?php else : ?> class="nav-link scrollto" <?php endif; ?> href="#">Trabaja con Nosotros</a></li>
        <li class="dropdown">
            <a href="#"><span>Canal de Denuncias</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="./actoscorrupcion.php">Acto de corrupción/Otros</a></li>
                <li><a href="./hostigamientosexual.php">Denuncias sobre Hostigamiento Laboral</a></li>
                <li><a href="#">Denuncia/Reclamo Laboral</a></li>
                <li><a href="./relacionescomunitarias.php">Consulta/Denuncia/Reclamos al cumplimiento <br>de pacto de Relaciones
                        comunitarias</a></li>
                <li><a href="./prevencioncontrol.php">Prevención y Control del Sistema Anticorrupción</a>
                </li>
            </ul>
        </li>
        <li><a <?php if ($urlPart[2] == 'intranet.php') : ?> class="nav-link scrollto active" <?php else : ?> class="nav-link scrollto" <?php endif; ?> href="#">Intranet</a></li>
    </ul>
    <i class="ms-4 bi bi-list mobile-nav-toggle"></i>
</nav><!-- .navbar -->