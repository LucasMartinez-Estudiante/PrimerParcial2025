<?php
    class Aerolinea{
        //Atributos
        private $identificacion;
        private $nombre;
        private $coleccion_vuelos_programados;

        //Método constructor por parámetros
        public function __construct($unaIdentificacion, $unNombre){
            $this->identificacion = $unaIdentificacion;
            $this->nombre = $unNombre;
            $this->coleccion_vuelos_programados = [];
        }

        //Métodos de acceso
        public function getIdentificacion(){
            return $this->identificacion;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getColeccionVuelosProgramados(){
            return $this->coleccion_vuelos_programados;
        }

        public function setIdentificacion($unaIdentificacion){
            $this->identificacion = $unaIdentificacion;
        }
        public function setNombre($unNombre){
            $this->nombre = $unNombre;
        }
        public function setColeccionVuelosProgramados($unaColeccion){
            $this->coleccion_vuelos_programados = $unaColeccion;
        }

        //Método __toString
        public function __toString(){
            //string $cadena, $vuelosStr
            //array $colVuelosProgramados
            //object $vuelo
            //bool $elementosEnArray
            $colVuelosProgramados = $this->getColeccionVuelosProgramados();
            $elementosEnArray = false;
            if (count($colVuelosProgramados) != 0){
                $elementosEnArray = true;
                $vuelosStr = "";
                foreach ($colVuelosProgramados as $vuelo){
                    $vuelosStr = $vuelosStr."\n".$vuelo;
                }
            }
                
            $cadena = "Identificación: ".$this->getIdentificacion()."\n";
            $cadena = $cadena."Nombre: ".$this->getNombre()."\n";
            $cadena = $cadena."Vuelos: ".(($elementosEnArray)?$vuelosStr:"No hay vuelos programados")."\n";
            return $cadena;
        }

        /** Método que recibe por parámetro un destino junto a una cantidad de asientos
         * libres y retorna una colección con los vuelos disponibles a ese destino
         * @param string $destino
         * @param int $cant_asientos
         * @return array
         */
        public function darVueloADestino($destino, $cant_asientos){
            //array $colVuelos, $colVuelosAerolinea
            //object $vuelo
            //string $destino_vuelo
            //int $asientos_disponibles
            $colVuelos = [];
            $colVuelosAerolinea = $this->getColeccionVuelosProgramados();
            
            foreach ($colVuelosAerolinea as $vuelo){
                $destino_vuelo = $vuelo->getDestino();
                $asientos_disponibles = $vuelo->getAsientos_Disponibles();

                if ($destino_vuelo == $destino && $asientos_disponibles >= $cant_asientos){
                    $colVuelos[] = $vuelo;
                }
            }
            return $colVuelos;
        }

        /** Método que recibe como parámetro un vuelo, verifica que no se encuentre
         * registrado ningún otro vuelo al mismo destino, en la misma fecha y con el
         * mismo horario de partida
         * @param object $vuelo
         * @return bool
         */
        public function incorporarVuelo(Vuelo $vuelo){
            //array $colVuelosProgramados, $fecha_revisar, $fecha
            //int $numero_total_vuelos, $i, $hora_partida_revisar, $hora_partida
            //bool $bandera
            //string $destino_revisar, $destino
            $colVuelosProgramados = $this->getColeccionVuelosProgramados();
            $numero_total_vuelos = count($colVuelosProgramados);
            $bandera = false;
            $i = 0;

            $destino_revisar = $vuelo->getDestino();
            $fecha_revisar = $vuelo->getFecha();
            $hora_partida_revisar = $vuelo->getHora_Partida();

            while ($i<$numero_total_vuelos && !$bandera){
                
                $destino = $colVuelosProgramados[$i]->getDestino();
                $fecha = $colVuelosProgramados[$i]->getFecha();
                $hora_partida = $colVuelosProgramados[$i]->getHora_Partida();

                if ($destino_revisar!=$destino && $fecha_revisar!==$fecha && $hora_partida_revisar!=$hora_partida){
                    $bandera = true;
                    $colVuelosProgramados[] = $vuelo;
                    $this->setColeccionVuelosProgramados($colVuelosProgramados);
                }
                $i++;
            }
            return $bandera;
        }

        /** Método que recibe por parámetro: la cantidad de asientos, el destino y una fecha. El método realiza la venta 
         * con el primer vuelo encontrado a ese destino, con los asientos disponibles y en la fecha deseada. 
         * @param int $una_cant_asientos
         * @param string $unDestino
         * @param array $unaFecha
         * @return object|null
         */
        public function venderVueloADestino($una_cant_asientos, $unDestino, $unaFecha){
            $colVuelosProgramados = $this->getColeccionVuelosProgramados();
            $numero_total_vuelos = count($colVuelosProgramados);
            $bandera = false;
            $i = 0;

            while ($i<$numero_total_vuelos && !$bandera){
                $destino = $colVuelosProgramados[$i]->getDestino();
                $fecha = $colVuelosProgramados[$i]->getFecha();

                $hayAsientos = $colVuelosProgramados[$i]->asignarAsientosDisponibles($una_cant_asientos);

                if ($hayAsientos && $unDestino==$destino && $unaFecha==$fecha){
                    $bandera = true;
                }

                $i++;
            }
            return ($bandera) ? $colVuelosProgramados[$i-1] : null;
        }

        /** Método que retorna el importe promedio recaudado por la aerolínea con cada uno de sus vuelos
         * @return float
         */
        public function montoPromedioRecaudado(){
            $promedio = 0;
            $colVuelosAerolinea = $this->getColeccionVuelosProgramados();
            $cant_vuelos = count($colVuelosAerolinea);

            if ($cant_vuelos > 0){
                foreach ($colVuelosAerolinea as $vuelo){
                    $v_importe = $vuelo->getImporte();
                    $v_asientos_vendidos = $vuelo->getAsientos_Totales() - $vuelo->getAsientos_Disponibles();
                    $imp_vuelo_recaudado = $v_importe * $v_asientos_vendidos;
                }
                $promedio = $imp_vuelo_recaudado / $cant_vuelos;
            }
            return $promedio;
        }
    }
?>