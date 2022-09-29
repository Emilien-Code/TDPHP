.DEFAULT_GOAL = run
name?=""

run: jeu.sh
	./jeu.sh

scores: scoreBoard.txt
	cat ./scoreBoard.txt 

reset-scores: 
	echo  > ./scoreBoard.txt

score-by:
	grep $(name) ./scoreBoard.txt
