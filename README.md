# Laravel gprc
Educational project.  
Contain a grpc server using nodejs and a php client using laravel framework

# How to Run
To run this project, make sure docker is installed on your local system, and port 80 is not currently used.
This project will have 3 containers from the docker-compose:
- Nginx to run laravel app
- PHP8.0-fpm with required extension
- Node for running server app, the server use sqlite memory for it's database, which means all data will be deleted on containe restart. The auth logic is also very simple.

## Makefile
```
make run
```
run docker/docker-compose detached
to stop, use:
```
make stop
```

## Manual
To start:
```
docker-compose -f docker/docker-compose.yml up --build
```

To stop:
```
docker-compose -f docker/docker-compose.yml down
```

# Usage
After all the containers finished starting, 2 HTTP endpoint on laravel client will be available on localhost:80
```
POST localhost/api/register
POST localhost/api/login
```
both require json body
```
{
  "username": "user name",
  "password": "user password"
}
```
