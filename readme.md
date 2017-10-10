# Laravel with Kafka, Presto Example

このサンプルは、 `/` にアクセスすると、アクセス情報をkafkaに通知、蓄積を行います。  

[PHPでビッグデータを操作しよう！](http://ytake.hateblo.jp/entry/2017/09/19/001155) 

上記URLのエントリで紹介したPresto ClientをLaravelから利用し、

Redis, MySQLとKafkaをPrestoで結合し、結合結果を返却します。


## uri

### presto
http://192.168.10.10:8080

### elasticsearch
http://192.168.10.10:9200

### kibana

## Kafka Connect Elasticsearch

[confluentinc/kafka-connect-elasticsearch](https://github.com/confluentinc/kafka-connect-elasticsearch)

```bin
$ connect-standalone /etc/schema-registry/connect-avro-standalone.properties /etc/kafka-connect-elasticsearch/quickstart-elasticsearch.properties
```


## Confluent

```
/usr/bin/                  # Confluent CLI and individual driver scripts for starting/stopping services, prefixed with <package> names
/etc/<package>/            # Configuration files
/usr/share/java/<package>/ # Jars
```