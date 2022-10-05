<?php
    require_once("./src/loader/Psr4ClassLoader.php");

    $classLoader = new loader\Psr4ClassLoader("iutnc\\spotibuse\\", "src/classes");
    $classLoader->register();

    
    use iutnc\spotibuse\audio\tracks as tracks ;
    use iutnc\spotibuse\audio\lists as lists ;
    use iutnc\spotibuse\render as renderer;
    use iutnc\spotibuse\exception as excception;


    try{

        $podcastTrack = new tracks\PodcastTrack('morceau 1', "../morceau.mp3", "un mec random", "2 avril");
        $audioTrack = new tracks\AlbumTrack('morceau 2', "../morceau.mp3",  "un mec random", "2 avril");


        $audioList = new lists\Playlist("nom de la liste");

        $audioList->addPist($podcastTrack);
        $audioList->addPist($audioTrack);
        $audioList->addPlaylist(array($podcastTrack, $audioTrack));
        foreach($audioList->tracks as $track){
            echo $track->titre.",\n";
        }   

    }catch(excception\InvalidPropertyNameException | Exception $e){

        echo 'Exception reçue : ',  $e->getMessage(), "\n";

    }



/////////////////////////////////////////


if(isset( $_SESSION["track"])){
    echo $_SESSION["test"];
    $unserialisedTrack = $_SESSION["track"];
    var_dump($unserialisedTrack);
    $renderer = new renderer\AlbumTrackRenderer($unserialisedTrack);
    echo $renderer->render(0);


}else{
    echo "<p>création de cookies</p>";
    $_SESSION['test'] = 'test';
    $albumTrack = new tracks\AlbumTrack("titre", "./test/test.mp3", "artiste", "date");
    $t = serialize($albumTrack);
    $renderer = new renderer\AlbumTrackRenderer(unserialize($t));
    echo $renderer->render(0);
    $_SESSION['track'] = $albumTrack;

}
