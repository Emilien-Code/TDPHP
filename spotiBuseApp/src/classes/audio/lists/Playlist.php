<?php
    namespace iutnc\spotibuse\audio\lists;

    class Playlist extends AudioList{

        public function __construct(string $name, array $tracks=[]){

            parent::__construct($name, $tracks);
    
        }
        public function __set(string $att, mixed $value) {
            $this->$att = $value;
        }
        public function addPist(\iutnc\spotibuse\audio\tracks\AudioTrack $piste){
            $this->tracks[] = $piste;
            $this->nbTracks += 1;
            $this->duration += $piste->duration;
        }
        public function removePist(int $index){
            unset($this->tracks[$index]) ;
        }

        public function addPlaylist(array $playlist){
            foreach($playlist as $piste){
                $this->tracks[] = $piste;
                $this->nbTracks += 1;
                $this->duration += $piste->duration;
            }   
        }
    }   
