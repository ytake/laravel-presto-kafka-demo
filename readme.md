# Laravel with Kafka Connect, Presto Example

## Usage

動作デモを確認する場合は `vagrant` をお使いください

### デモ環境の起動  

```bash
$ vagrant up
```

### kafka connectの起動

vagrantの環境が起動したら、下記コマンドで仮想サーバにアクセスしてください。

```bash
$ vagrant ssh
```

次に Kafka Connect Elasticsearchを起動させます

```bash
$ sudo connect-standalone -daemon /etc/schema-registry/connect-standalone.properties /etc/kafka-connect-elasticsearch/elasticsearch-connect.properties
$ sudo confluent load elasticsearch-sink
```

上記のコマンドで、指定のtopicに格納されたメッセージは、  
Elasticsearchのindex (fulltext.register) に挿入されます。  

### Presto with Log(Kafka Consumer)

Redis, MySQL, Kafkaに格納されたデータをアクセスログ出力時に    
Elasticsearchに格納するデモが含まれています。  

これを利用する場合は、次のコマンドを実行して初期データ投入を行なってください。

*vagrant sshで仮想サーバにアクセスしてから実行します*

```bash
# データベース作成とデモデータ投入
$ php artisan migrate --seed

# Redisにデモデータ投入
$ php artisan init:redis
```

次にKafka Consumerを起動してください  

supervisorに登録するとdaemonとして動作しますが(vagrantにインストール済み)、  

デモの動作確認はコンソール上で起動 でも良いです

```bash
$ php artisan kafka:consumer
```

これでKafkaのConsumerが動作し、topicにデータが格納されると、  

Presto経由で各データベースを結合し、データを組み合わせたアクセスログを生成し、  

Elasticsearchに格納されます 

## uri

### presto
http://192.168.10.10:8080

### elasticsearch
http://192.168.10.10:9200

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
