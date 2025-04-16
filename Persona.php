<?php
    class Persona{
        //Atributos
        private $nombre;
        private $apellido;
        private $direccion;
        private $mail;
        private $telefono;

        //Constructor por parámetros
        public function __construct($unNombre,$unApellido,$unaDireccion,$unMail,$unTelefono){
            $this->nombre = $unNombre;
            $this->apellido = $unApellido;
            $this->direccion = $unaDireccion;
            $this->mail = $unMail;
            $this->telefono = $unTelefono;
        }

        //Métodos Getter y Setter
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getMail(){
            return $this->mail;
        }
        public function getTelefono(){
            return $this->telefono;
        }

        public function setNombre($unNombre){
            $this->nombre = $unNombre;
        }
        public function setApellido($unApellido){
            $this->apellido = $unApellido;
        }
        public function setDireccion($unaDireccion){
            $this->direccion = $unaDireccion;
        }
        public function setMail($unMail){
            $this->mail = $unMail;
        }
        public function setTelefono($unTelefono){
            $this->telefono = $unTelefono;
        }

        //Método __toString redefinido
        public function __toString(){
            return "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido()."\nDirección: ".$this->getDireccion()."\nMail: ".$this->getMail()."\nTeléfono: ".$this->getTelefono()."\n\n";
        }
    }
?>