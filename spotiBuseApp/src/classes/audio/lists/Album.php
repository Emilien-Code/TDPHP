<?php
    namespace iutnc\spotibuse\audio\lists;
    
    class Album extends AudioList{

        private $artiste;
        private $dateDeSortie;

        public function __construct(string $artiste,string $dateDeSortie,string $name, array $tracks){
            $this->artiste = $artiste;
            $this->dateDeSortie = $dateDeSortie;

            parent::__construct($name, $tracks);
    
        }
        public function __set(string $att, mixed $value) {
            if($att!="tracks"){
                $this->$att = $value;
            }
        }
    }   
