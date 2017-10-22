# Laravel with Kafka Connect, Presto Example

## Usage

動作を確認する場合は `vagrant` をお使いください

### デモ環境の起動  

```bash
$ vagrant up
```

### kafka connectの起動

vagrantの環境が起動したら、下記コマンドで仮想サーバにアクセスしてください。

```bash
$ vagrant ssh
```

仮想サーバログイン後、次のコマンドでプロジェクトのディレクトリに移動してください

```bash
$ cd laravel-presto-kafka-demo
```

次に Kafka Connect Elasticsearchの起動と、Elasticsearchのindexの設定などを行います。  

これらは下記のコマンドを実行してください

```bash
[vagrant@gardening:~/laravel-presto-kafka-demo] $ ./bin/init.sh
```

上記のコマンドで、指定のtopicに格納されたメッセージは、  
Elasticsearchのindex (fulltext.register) に挿入されます。  

### Presto with Log(Kafka Consumer)

Redis, MySQL, Kafkaに格納されたデータをアクセスログ出力時に    
Elasticsearchに格納するデモが含まれています。  

これを利用する場合は、プロジェクト配下で次のcomposerコマンドを実行して初期データ投入を行なってください。

```bash
# データベース作成とデモデータ投入、Redisにデモデータ投入
[vagrant@gardening:~/laravel-presto-kafka-demo] $ composer project-setup
```

次にKafka Consumerを起動してください  

supervisorに登録するとdaemonとして動作しますが(vagrantにインストール済み)、コンソールで起動しても構いません

```bash
$ php artisan kafka:consumer
```

これでKafkaのConsumerが動作し、topicにデータが格納されると、  

Presto経由で各データベースを結合し、データを組み合わせたアクセスログを生成し、  

Elasticsearchに格納されます 

## uri

### Application
http://192.168.10.10 or gardening.app

### presto
http://192.168.10.10:8080

### elasticsearch
http://192.168.10.10:9200

### elasticsearch indices
http://192.168.10.10:9200/_cat/indices?v&pretty

## Kafka Connect Elasticsearch

[confluentinc/kafka-connect-elasticsearch](https://github.com/confluentinc/kafka-connect-elasticsearch)

## Confluent 

Directories

```
/usr/bin/                  # Confluent CLI and individual driver scripts for starting/stopping services, prefixed with <package> names
/etc/<package>/            # Configuration files
/usr/share/java/<package>/ # Jars
```
