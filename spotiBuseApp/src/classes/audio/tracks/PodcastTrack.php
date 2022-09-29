<?php
    namespace iutnc\spotibuse\audio\tracks;
    
    class PodcastTrack extends AudioTrack{

        protected $genre;

        public function __construct(string $titre, string $path, string $artiste, string $date){

            parent::__construct($titre, $path, $artiste, $date);
            $this->genre = "initial value";

        }

    }