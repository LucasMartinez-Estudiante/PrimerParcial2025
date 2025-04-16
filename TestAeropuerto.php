<?php
    include_once "Persona.php";
    include_once "Vuelo.php";
    include_once "Aerolinea.php";
    include_once "Aeropuerto.php";

    /** Programa Principal Test
     * 
     */
    $objPersona_1 = new Persona("Roberto","Martinez","Av Bs 123","unadireccion@mail.com",2885030686);

    $objAerolinea_1 = new Aerolinea(1,"Argentina");
    $objAerolinea_2 = new Aerolinea(2,"Uruguay");
    $colAerolineas = [$objAerolinea_1,$objAerolinea_2];

    $objVuelo_1 = new Vuelo(1,1000,"Madagascar",1300,900,$objPersona_1,100,10);
    $objVuelo_2 = new Vuelo(1,1000,"Madagascar",1300,900,$objPersona_1,100,9);
    $objVuelo_3 = new Vuelo(2,2000,"Japon",2100,1400,$objPersona_1,50,12);
    $objVuelo_4 = new Vuelo(2,2000,"Japon",2100,1400,$objPersona_1,50,11);

    $objAeropuerto_1 = new Aeropuerto("Aerolinea","Av Bs 12",$colAerolineas);

    