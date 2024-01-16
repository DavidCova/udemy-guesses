# udemy-guesses

```sh
./start.sh
docker exec -it udemy-guesses sh
# su
./bin/console messenger:consume guesses-async -vv
# In your udemy-games microservice, make sure that the containers are running before trying the next step

#create game
curl --location --request POST 'localhost:8000/api/games' \
--header 'Content-Type: application/json' \
--data-raw '{"homeTeam": "Sporting","awayTeam":"Chaves"}'

#guess game
curl --location --request POST 'localhost:8001/api/guesses' \
--header 'Content-Type: application/json' \
--data-raw '{
    "homeTeam": "Sporting",
    "awayTeam": "Chaves",
    "guess":"2-0",
    "username": "Cova"
}'

#end game
curl --location --request POST 'localhost:8000/api/games/end' \
--header 'Content-Type: application/json' \
--data-raw '{"homeTeam": "Sporting","awayTeam": "Chaves", "result":"1-0"}'
```