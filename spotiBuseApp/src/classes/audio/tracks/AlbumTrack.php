<?php
    namespace iutnc\spotibuse\audio\tracks;
    class AlbumTrack extends AudioTrack{

        protected $album;
        protected $numeroDePiste;


        public function __construct(string $titre, string $path, string $artiste, string $date){
            
            parent::__construct($titre, $path, $artiste, $date);
            $this->album = "initial value";
            $this->numeroDePiste = "initial value";
       
        }

    }