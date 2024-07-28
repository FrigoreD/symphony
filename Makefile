##################
# Docker compose
##################

dc_build:
	sudo docker compose -f ./docker/docker-compose.yml build

dc_start:
	sudo docker compose -f ./docker/docker-compose.yml start

dc_stop:
	sudo docker compose -f ./docker/docker-compose.yml stop

dc_up:
	sudo docker compose -f ./docker/docker-compose.yml up -d --remove-orphans

dc_ps:
	sudo docker compose -f ./docker/docker-compose.yml ps

dc_logs:
	sudo docker compose -f ./docker/docker-compose.yml logs -f

dc_down:
	sudo docker compose -f ./docker/docker-compose.yml down -v --rmi=all --remove-orphans


##################
# App
##################

app_bash:
	sudo docker compose -f ./docker/docker-compose.yml exec -u www-data php-fpm bash