DOCKER_IMAGE_NAME=php8.0-grpc
DOCKER_IMAGE_VERSION=latest
DOCKERFILE=dockerfile

.PHONY: docker-build
docker-build:
	docker build -t $(DOCKER_IMAGE_NAME):$(DOCKER_IMAGE_VERSION) -f docker/$(DOCKERFILE) .

.PHONY: generate-proto
generate-proto:
	cd grpc-server/protos
	docker run -v `pwd`:/defs namely/protoc-all -d -l php -o library/