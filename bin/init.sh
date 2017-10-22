#!/usr/bin/env bash

sudo connect-standalone -daemon /etc/schema-registry/connect-standalone.properties /etc/kafka-connect-elasticsearch/elasticsearch-connect.properties
sudo confluent load elasticsearch-sink

# https://github.com/confluentinc/kafka-connect-elasticsearch/blob/master/docs/elasticsearch_connector.rst

# Update Indices Settings

curl -XPUT 'localhost:9200/log.index?pretty' -H 'Content-Type: application/json' -d'
{
    "settings" : {
        "index" : {
            "number_of_shards" : 5,
            "number_of_replicas" : 0
        }
    }
}
'

curl -XPUT 'localhost:9200/fulltext.register/_settings?pretty' -H 'Content-Type: application/json' -d'
{
    "index" : {
        "number_of_replicas" : 0
    }
}
'

curl -XPUT "localhost:9200/log.index/_mapping/logs?pretty" -H 'Content-Type: application/json' -d'
{
  "properties": {
    "created_at": {
      "type":     "text",
      "fielddata": true
    }
  }
}
'

