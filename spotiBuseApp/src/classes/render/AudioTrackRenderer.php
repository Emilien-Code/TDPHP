<?php
    namespace iutnc\spotibuse\render;

    abstract class AudioTrackRenderer implements Renderer {
     
        private $affichage ;
        private $albumTrack;

        public function __construct(AlbumTrack $albumTrack){
            $this->albumTrack = $albumTrack;
            $this->affichage = "compact";
        }

        public function render(int $selector): string{
            $html = $selector == Renderer::COMPACT ? "
                    <audio> <!-- compact -->
                        controls
                        src=\"{$this->albumTrack->path}\"
                        Your browser does not support the <code>audio</code> element.
                    </audio>
                " : $this->affichageLong($this->albumTrack->path, $this->albumTrack->titre, $this->albumTrack->artiste, $this->albumTrack->date);

            return $html;
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


  
            $this -> $nom_att = $valeur;
        
        }

    }