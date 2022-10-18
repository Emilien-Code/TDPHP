<?php
/* Les informations de connexion */
       
       
foreach ($_SERVER as $k => $v)
       echo "$k => $v <br />\n";

$config = parse_ini_file("./config.ini");
$serveur = $config["serveur"];
$base = $config["base"];
$user = $config["user"];
$pass = $config["pass"];
$params = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);

$dsn = "mysql:host=$serveur;dbname=$base";

echo "<nav>
<a href=\"http://localhost/Emilien/TD3/main.php?actions=all_users\"> all users</a> | <a href=\"http://localhost/Emilien/TD3/main.php?actions=all_tweets\"> all tweets</a> | <a href=\"http://localhost/Emilien/TD3/main.php?actions=add_user\"> add user </a>
</nav>";


if( $_GET["actions"] === "all_tweets" ){
       $requete = 'SELECT * FROM tweet';
       try {
              $db = new \PDO($dsn, $user, $pass, $params);
              $requete_prep = $db->prepare( $requete );  
       
              
              if ( $requete_prep->execute() ){
                     echo "<div>";
                     while ( $ligne =  $requete_prep->fetch( PDO::FETCH_OBJ ) ){
                            echo '<p>';
                            print_r($ligne) ;
                            echo '</p>';
                     }  
                     echo "</div>";
              }
       
              else{
                     echo "something wrong went";
              }
       
       
       
       
       } catch(\PDOException $e) {
              echo "Connection error: $dsn" . $e->getMessage();
              exit;
       }
}

if( $_GET["actions"] === "all_users" ){
       $requete = 'SELECT * FROM user';
       try {
              $db = new \PDO($dsn, $user, $pass, $params);
              $requete_prep = $db->prepare( $requete );  
       
              
              if ( $requete_prep->execute() ){
                     echo "<div>";
                     while ( $ligne =  $requete_prep->fetch( PDO::FETCH_OBJ ) ){
                            echo '<p>';
                            print_r($ligne) ;
                            echo '</p>';
                     }  
                     echo "</div>";
              }
       
              else{
                     echo "something wrong went";
              }
       
       
       
       
       } catch(\PDOException $e) {
              echo "Connection error: $dsn" . $e->getMessage();
              exit;
       }
}

if( $_GET["actions"] === "add_user" ){
       echo "<form method=\"POST\" action=\"http://localhost/Emilien/TD3/main.php?actions=create_user\">
              <input type=\"text\" placeholder=\"full name\" name=\"fullname\"/>
              <input type=\"text\" placeholder=\"user name\" name=\"username\"/>
              <input type=\"password\" placeholder=\"password\" name=\"password\"/>
              <button type=\"submit\">Create account</button>
       </form>";
}
if( $_GET["actions"] === "create_user"){
       $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_SPECIAL_CHARS );
       $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS );
       $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS );
       
       $requete = "INSERT INTO user VALUES (null, ?, ?, ?, 0, 0)";


       try {
              $db = new \PDO($dsn, $user, $pass, $params);
              $requete_prep = $db->prepare( $requete );  
       
              
              if ( $requete_prep->execute( Array($fullname, $username, $password)) ){

                     echo "<p>Votre compte à bien été créé</p>";

              }
       
              else{
                     echo "something wrong went";
              }

       
       } catch(\PDOException $e) {
              echo "Connection error: $dsn" . $e->getMessage();
              exit;
       }
}


