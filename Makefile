DOCKER_IMAGE_NAME=php8.0-grpc
DOCKER_IMAGE_VERSION=latest
DOCKERFILE=dockerfile
GRPC_SERVER_DIR=grpc-server
DIR := ${CURDIR}

.PHONY: docker-build
docker-build:
	docker build -t $(DOCKER_IMAGE_NAME):$(DOCKER_IMAGE_VERSION) -f docker/$(DOCKERFILE) .

.PHONY: generate-proto
generate-proto:
	docker run --rm -v $(DIR)/$(GRPC_SERVER_DIR):/defs namely/protoc-all -d protos -l php -o library/
