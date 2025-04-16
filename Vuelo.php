<?php
    class Vuelo{
        //Atributos
        private $numero;
        private $importe;
        private $fecha;
        private $destino;
        private $hora_arribo;
        private $hora_partida;
        private $cantidad_asientos_totales; //(REVISAR) Es posible que ambas cantidades puedan hallarse en una misma, cant total no tiene uso
        private $cantidad_asientos_disponibles;
        private Persona $persona;

        //Método constructor por parámetros
        public function __construct($unNumero, $unImporte, $unDestino, $unaHora_arribo, $unaHora_partida, $objPersona,$asientos_total,$asientos_disponibles){
            $this->numero = $unNumero;
            $this->importe = $unImporte;
            $this->fecha = getdate();
            $this->destino = $unDestino;
            $this->hora_arribo = $unaHora_arribo;
            $this->hora_partida = $unaHora_partida;
            $this->cantidad_asientos_totales = $asientos_total;
            $this->cantidad_asientos_disponibles = $asientos_disponibles;
            $this->persona = $objPersona;
        }

        //Métodos de acceso
        public function getNumero(){
            return $this->numero;
        }
        public function getImporte(){
            return $this->importe;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getDestino(){
            return $this->destino;
        }
        public function getHora_Arribo(){
            return $this->hora_arribo;
        }
        public function getHora_Partida(){
            return $this->hora_partida;
        }
        public function getAsientos_Totales(){
            return $this->cantidad_asientos_totales;
        }
        public function getAsientos_Disponibles(){
            return $this->cantidad_asientos_disponibles;
        }
        public function getPersona(){
            return $this->persona;
        }

        public function setNumero($unNumero){
            $this->numero = $unNumero;
        }
        public function setImporte($unImporte){
            $this->importe = $unImporte;
        }
        public function setFecha($unaFecha){
            $this->fecha = $unaFecha;
        }
        public function setDestino($unDestino){
            $this->destino = $unDestino;
        }
        public function setHora_Arribo($unaHora_arribo){
            $this->hora_arribo = $unaHora_arribo;
        }
        public function setHora_Partida($unaHora_partida){
            $this->hora_partida = $unaHora_partida;
        }
        public function setAsientos_Totales($cantidad_asientos_totales){
            $this->cantidad_asientos_totales = $cantidad_asientos_totales;
        }
        public function setAsientos_Disponibles($cantidad_asientos_disponibles){
            $this->cantidad_asientos_disponibles = $cantidad_asientos_disponibles;
        }
        public function setPersona(Persona $objPersona){
            $this->persona = $objPersona;
        }


        // //Método __toString redefinido
        // public function __toString(){            (REVISAR)
        //     return
        // }


        /** Método que recibe por parámetros la cantidad de asientos que desean 
         * asignarse y de ser necesario actualizando la información del vuelo
         * @param int $cantidad_pasajeros
         * @return bool
         */
        public function asignarAsientosDisponibles($cantidad_pasajeros){
            //bool $asigna
            //int $cantidad_asientos_disponibles
            $asigna = false;
            $cantidad_asientos_disponibles = $this->getAsientos_Disponibles();
            
            if ($cantidad_asientos_disponibles <= $cantidad_pasajeros){
                $asigna = true;
                $this->setAsientos_Disponibles($cantidad_asientos_disponibles - $cantidad_pasajeros);
            }
            return $asigna;
        }
    }