Phalcon Volt with ReactJS integration experiment
---

### Installation

First install dependencies and build js
```bash
docker run -it --rm --volume $PWD:/src prcy/phalcon:3.4.x composer install --working-dir=/src
docker run -it --rm --volume $PWD:/workspace kkarczmarczyk/node-yarn yarn install
docker run -it --rm --volume $PWD:/workspace kkarczmarczyk/node-yarn yarn exec webpack
```

Add `127.0.0.1       react.local` to your `/etc/hosts` and run

```bash
docker-compose up
```
