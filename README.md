<h1 align="center">
  Bookmark Manager - DDD CQRS
</h1>

<p align="center">
    <a href="https://github.com/dvidz"><img src="https://img.shields.io/badge/Dvidz-Github-green.svg?style=flat-square" alt="dvidz"/></a>
    <a href="#"><img src="https://img.shields.io/badge/Symfony-6.0-purple.svg?style=flat-square&logo=symfony" alt="Symfony 6.0"/></a>
    <a href="https://github.com/dvidz/bookmark-manager/actions"><img src="https://github.com/dvidz/bookmark-manager-clean/workflows/CI/badge.svg?branch=main" alt="CI pipeline status" /></a>
</p>

<p align="center">
  An API to manage your Flickr and Vimeo Bookmarks
</p>

## Environment Setup

### Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/dvidz/bookmark-manager-clean bookmark-manager-clean`
3. Move to the project folder: `cd bookmark-manager-clean`

### Environment configuration

1. Create a local environment file (`cp .env .env.local`) if you want to modify any parameter

### Application execution

1. Install all the dependencies and bring up the project with Docker executing: `make build`
2. Install database: `make database-create`
3. Then api is available:
    1. [API](src/apps/api): http://127.0.0.1:8000/api/bookmark

### Tests execution
1. Run the docker container if not running : `make start`
2. Purge the database:
   1. `make database-drop`
   2. `make database-create`
3. Execute phpcs, psalm, phpunit and behat tests: `make tests`

### Mysql is alive?
1. ping the mysql container: `make ping-mysql`

### Docker containers
1. Build containers: `make build`
2. Stop containers: `make stop`
3. Destroy containers: `make destroy`

### Documentation phpdoc
1. run symfony server
   1. `symfony server:start --dir=phpdoc`
   2. Open browser to view phpdoc in html format : `http://127.0.0.1:8001` or `http://127.0.0.1:8000`