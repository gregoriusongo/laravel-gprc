CLIENT_DOCKER_IMAGE_NAME=php8.0-grpc
SERVER_DOCKER_IMAGE_NAME=grpc-server-node
DOCKER_IMAGE_VERSION=latest
DOCKERFILE=dockerfile
GRPC_SERVER_DIR=grpc-server
GRPC_CLIENT_DIR=grpc-client
DIR := ${CURDIR}

.PHONY: run-attached
run-attached:
	docker-compose -f docker/docker-compose.yml up --build

.PHONY: run
run:
	docker-compose -f docker/docker-compose.yml up --build -d

.PHONY: stop
stop:
	docker-compose -f docker/docker-compose.yml down

.PHONY: docker-build
docker-build:
	docker build -t $(CLIENT_DOCKER_IMAGE_NAME):$(DOCKER_IMAGE_VERSION) -f docker/$(DOCKERFILE) .
	docker build -t $(SERVER_DOCKER_IMAGE_NAME):$(DOCKER_IMAGE_VERSION) -f grpc-server-node/$(DOCKERFILE) .

.PHONY: generate-proto
generate-proto:
	docker run --rm -v $(DIR)/$(GRPC_SERVER_DIR):/defs namely/protoc-all -d protos -l php -o library/
	docker run --rm -v $(DIR)/$(GRPC_SERVER_DIR):/defs namely/protoc-all -d protos -l php -o $(DIR)/$(GRPC_CLIENT_DIR)/library/
