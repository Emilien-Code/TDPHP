<?php
    namespace iutnc\spotibuse\audio\lists;    
    abstract class AudioList {
        protected $name;
        protected $duration;
        protected $tracks;
        protected $nbTracks;


        public function __construct(string $name, array $tracks=[]){
            $this->name = $name;
            $this->tracks = $tracks;
            $this->nbTracks = count($tracks);
            $this->duration = 0;
            foreach($tracks as $track){
                $this->duration += $track->duration;
            }   
        }
        public function __get(string $attribut):mixed{
            return $this->$attribut;
        }
    }