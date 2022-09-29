<?php
    namespace iutnc\spotibuse\render;

    class PodcastTrackRenderer extends AudioTrackRenderer {
        
        public function __construct(PodcastTrack $albumTrack){
            parent::__construct($albumTrack);
        }


        public function affichageLong($path, $titre, $artiste, $date){
            return "
            <div>
            <h1Vous écoutez $titre<h1/>
            <p>par $artiste, sorti le $date</p>  
                <audio>
                    controls
                    src=\"{$path}\"
                    Your browser does not support the <code>audio</code> element.
                </audio>
            </div>";
        }



    }