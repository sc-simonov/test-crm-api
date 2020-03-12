# REQUIRED SECTION
ROOT_DIR:=$(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
include $(ROOT_DIR)/.mk-lib/common.mk
# END OF REQUIRED SECTION

DEFAULT_SERVICE := app

.PHONY: help dependencies up start stop restart status ps clean

dependencies: check-dependencies ## Check dependencies

up: ## Start all or c=<name> containers in foreground
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) up $(c)

build: ## Builds all or c=<name> containers
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) build $(c)

start: ## Start all or c=<name> containers in background
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) up -d $(c)

stop: ## Stop all or c=<name> containers
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) stop $(c)

restart: ## Restart all or c=<name> containers
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) stop $(c)
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) up $(c) -d

status: ## Show status of containers
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) ps

ps: status ## Alias of status

clean: confirm ## Clean all data
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) down

install: ## Installs application dependencies, migrations and fixtures
	cp $(ROOT_DIR)/http-client.env.json.sample cp $(ROOT_DIR)/http-client.env.json
	cp $(ROOT_DIR)/.env.sample $(ROOT_DIR)/.env
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) build $(c)
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) up -d $(c)
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) exec app composer install
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) exec app php bin/console doctrine:migrations:migrate
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) exec app php bin/console doctrine:fixtures:load

bash: ## Execute bash in default or c=<name> container
ifdef c
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) exec $(c) bash
else
	@$(DOCKER_COMPOSE) -f $(DOCKER_COMPOSE_FILE) exec $(DEFAULT_SERVICE) bash
endif