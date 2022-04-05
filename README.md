# README

```sql
CREATE USER 'developer'@'%' IDENTIFIED BY 'P2!D4NA;@_#6kZnXF7br:e<>uE/,]w.R';
GRANT ALL ON *.* TO 'developer'@'%';
FLUSH PRIVILEGES;
```

## Start Elastic Search

```bash
#!/usr/bin/env bash

set -aeuo pipefail

docker network create elastic
docker run \
  --name es-node01 \
  --net elastic \
  -p 9200:9200 \
  -p 9300:9300 -t \
  docker.elastic.co/elasticsearch/elasticsearch:8.1.2

docker run \
  -p 9200:9200 \
  -p 9300:9300 \
  -e "discovery.type=single-node" \
  --network base_share_network \
  docker.elastic.co/elasticsearch/elasticsearch:8.1.2

docker run \
  --name kibana \
  --net elastic \
  -p 5601:5601 \
  docker.elastic.co/kibana/kibana:8.1.2

bin/elasticsearch-reset-password
```

```
curl -s --cacert config/certs/ca/ca.crt -u elastic:P2D4NA_6kZnXF7br https://es01:9200
curl -s -X POST --cacert tmp/certs/ca/ca.crt -u elastic:dev -H "Content-Type: application/json" https://localhost:9200/_security/user/kibana_system/_password -d "{\"password\":\"dev\"}"
```
