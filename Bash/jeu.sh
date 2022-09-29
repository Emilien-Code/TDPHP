#!/bin/sh

    randomNumber=${RANDOM:0:2}
    userNumber=-1
    steps=0
    isWin=0
    tries=0
    countLine=0
    areCheatAllowed=0
    max_try=0
    max_scores_stored=0
    nb_char_max=0


    # Reading config file and register data
    while read line; do

        if [ ${countLine} == 0 ]; then

            areCheatAllowed=`echo $line | cut -d ':' -f2`

        elif [ ${countLine} == 1 ]; then

            max_try=`echo $line | cut -d ':' -f2`

        elif [ ${countLine} == 2 ]; then

            max_scores_stored=`echo $line | cut -d ':' -f2`

        elif [ ${countLine} == 3 ]; then

            nb_char_max=`echo $line | cut -d ':' -f2`

        fi

        countLine=$((countLine+1))
    
    done < "./config.txt"




    echo "Bienvenu honorable joueur.\nSaurez vous retrouvez la juste valeur ? Celle ci est comprise entre 0 et 99."

    if [ $areCheatAllowed == 1 ]; then

        echo "${randomNumber}"

    fi

    # While player hasn't win and under max_tries
    while ((!$isWin && $max_try != $tries)) ; do
        
        steps=$((steps+1))
        read -r userNumber 


        tries=$((tries+1))

        if [ $randomNumber == $userNumber ]; then
            isWin=1
        fi
    done




    # If player won  : 
    if [ $isWin == 1 ]; then 
        echo "Félicitation, vous avez trouvé ! Il vous a fallu ${steps} coup(s)\nVoulez vous enregistrer votre score ? (y,n)"

        read -r wannaRegister

        if [ "${wannaRegister}" == "y" ]; then 
            #if [ ${max_scores_stored} >= wc -l ./scoreBoard.txt | grep -o -E '[0-9]+' ]; then # ./jeu.sh: line 75: [: missing `]' grep: ]: No such file or directory

                echo "Veuillez saisir votre nom honorable vainqueur : "
                read -r playerName

                if [ ! -f "./scoreBoard.txt" ] ; then
                    touch "./scoreBoard.txt"
                fi

                touch ./tempScoreBoard.txt

                cat ./scoreBoard.txt > ./tempScoreBoard.txt

                echo "L'honorable joueur ${playerName} à réussi en ${steps} coup(s)" >> "./tempScoreBoard.txt"

                cat tempScoreBoard.txt | sort -k 7n > ./scoreBoard.txt 
                
                rm "./tempScoreBoard.txt"


            #else 

            #    echo "Le nombre de score max est atteint. Impossible d'en rajouter"

            #fi
        fi
    fi
    

    echo "Merci d'avoir joué <3"
