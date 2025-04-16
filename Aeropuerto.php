<?php
    class Aeropuerto{
        //Atributos
        private $denominacion;
        private $direccion;
        private $colAerolineas;

        //Constructor por parámetros
        public function __construct($denominacion, $direccion, $colAerolineas){
            $this->denominacion = $denominacion;
            $this->direccion = $direccion;
            $this->colAerolineas = $colAerolineas;
        }

        //Métodos de acceso
        public function getDenominacion(){
            return $this->denominacion;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getColeccionAerolineas(){
            return $this->colAerolineas;
        }

        public function setDenominacion($denominacion){
            $this->denominacion = $denominacion;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setColeccionAerolineas($colAerolineas){
            $this->colAerolineas = $colAerolineas;
        }

        //Método __toString redefinido
        public function __toString(){
            //string $cadena, $aerolineasStr
            //array $colAerolineas
            //object $aerolinea
            //bool $elementosEnArray
            $colAerolineas = $this->getColeccionAerolineas();
            $elementosEnArray = false;
            if (count($colAerolineas) != 0){
                $elementosEnArray = true;
                $aerolineasStr = "";
                foreach ($colAerolineas as $aerolinea){
                    $aerolineasStr = $aerolineasStr."\n".$aerolinea;
                }
            }
                
            $cadena = "Denominación: ".$this->getDenominacion()."\n";
            $cadena = $cadena."Dirección: ".$this->getDireccion()."\n";
            $cadena = $cadena."Aerolíneas que arriban: ".(($elementosEnArray)?$aerolineasStr:"No hay aerolíneas")."\n";
            return $cadena;
        }

        /** Método que recibe por parámetro una aerolínea y retorna todos los vuelos asignados a esta
         * @param object $aerolinea
         * @return string
         */
        public function retornarVuelosAerolinea(Aerolinea $aerolinea){
            //string $cadena, $vuelosStr
            //array $colVuelosProgramados
            //object $vuelo
            //bool $elementosEnArray
            $colVuelosProgramados = $aerolinea->getColeccionVuelosProgramados();
            $elementosEnArray = false;
            if (count($colVuelosProgramados) != 0){
                $elementosEnArray = true;
                $vuelosStr = "";
                foreach ($colVuelosProgramados as $vuelo){
                    $vuelosStr = $vuelosStr."\n".$vuelo;
                }
            }

            return ($elementosEnArray) ? $vuelosStr."\n" : "Esta aerolínea no tiene vuelos programados\n";
        }

          /** Método que recibe por parámetro la cantidad de asientos, una 
         * fecha y un destino y el aeropuerto realiza automáticamente la 
         * asignación al vuelo
         * @param int $cant_asientos
         * @param array $unaFecha
         * @param string $unDestino
         */
        public function ventaAutomatica($cant_asientos, $unaFecha, $unDestino){
            $colAerolineas = $this->getColeccionAerolineas();
            $numero_aerolineas = count($colAerolineas);

            $i = 0;
            $bandera = false;

            while ($i<$numero_aerolineas && !$bandera){
                $j = 0;
                $colVuelos = $colAerolineas[$i]->getColeccionVuelosProgramados();
                $numero_vuelos = count($colVuelos);

                while ($j<$numero_vuelos && !$bandera){
                    $asientos_disponibles = $colVuelos[$j]->getAsientos_Disponibles();
                    $fecha = $colVuelos[$j]->getFecha();
                    $destino = $colVuelos[$j]->getDestino();

                    if ($cant_asientos>=$asientos_disponibles && $unaFecha == $fecha && $unDestino == $destino){
                        $colVuelos[$j]->asignarAsientosDisponibles($cant_asientos);
                        $bandera = true;
                    }
                    $j++;
                }
                $i++;
            }
        }

    }
