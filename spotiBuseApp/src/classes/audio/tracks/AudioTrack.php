<?php
    namespace iutnc\spotibuse\audio\tracks;
    abstract class AudioTrack  {
        
        protected $titre;
        protected $artiste;
        protected $date;
        protected $path;
        protected $duration;


        public function __construct(string $titre, string $path, string $artiste, string $date, int $duration=180){
           
            $this->titre = $titre;
            $this->path = $path;
            $this->artiste = $artiste;
            $this->date = $date;
            $this->duration = $duration;
        
        }


        public function __get(string $nom_att) : mixed{
            
            if(!property_exists($this, $nom_att)){
                throw new InvalidPropertyNameException();
            }

            return $this -> $nom_att ;

        }


        public function __set($nom_att, $valeur){
            if(!property_exists($this, $nom_att)){
                throw new InvalidPropertyNameException();
            }
            if($nom_att === "path" || $nom_att ==="titre"){
                throw new NonEditablePropertyException();
            }
            if($nom_att === "duree" && $valeur < 0){
                throw new InvalidPropertyValueException();
            }
            
            $this -> $nom_att = $valeur;
        }


        public function __toString() : string{

            return json_encode($this);

        }

        
    }

