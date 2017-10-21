#!/bin/sh

sudo yum install nc nmap -y

SELF_IP=`ifconfig enp0s8 | awk '/inet / {print $2}'`

# install Apache Kafka From Confluent
sudo rpm --import http://packages.confluent.io/rpm/3.3/archive.key

sudo cat > /etc/yum.repos.d/confluent.repo << EOF
[Confluent.dist]
name=Confluent repository (dist)
baseurl=http://packages.confluent.io/rpm/3.3/7
gpgcheck=1
gpgkey=http://packages.confluent.io/rpm/3.3/archive.key
enabled=1

[Confluent]
name=Confluent repository
baseurl=http://packages.confluent.io/rpm/3.3
gpgcheck=1
gpgkey=http://packages.confluent.io/rpm/3.3/archive.key
enabled=1
EOF

sudo yum clean all
sudo yum -y install confluent-platform-oss-2.11

sudo echo "
advertised.listeners=PLAINTEXT://$SELF_IP:9092
" >> /etc/kafka/server.properties
sudo sed -i "s|zookeeper.connect=localhost:2181|zookeeper.connect=$SELF_IP:2181|g" /etc/kafka/server.properties

# install prestodb

wget https://repo1.maven.org/maven2/com/facebook/presto/presto-server/0.185/presto-server-0.185.tar.gz
tar -xvf presto-server-0.185.tar.gz
rm -rf presto-server-0.185.tar.gz

chown -R vagrant:vagrant presto-server-0.185
cp -r /home/vagrant/laravel-presto-kafka-demo/presto/etc/ /home/vagrant/presto-server-0.185/etc

# install presto-cli
wget https://repo1.maven.org/maven2/com/facebook/presto/presto-cli/0.185/presto-cli-0.185-executable.jar
mv presto-cli-0.185-executable.jar presto
chmod 755 presto
chown -R vagrant:vagrant presto
sudo ./presto-server-0.185/bin/launcher start

# elasticsearch
echo "network.host: 0.0.0.0" >> "/etc/elasticsearch/elasticsearch.yml"
sudo sed -i "s|-Xms2g|-Xms1g|g" /etc/elasticsearch/jvm.options
sudo sed -i "s|-Xmx2g|-Xmx1g|g" /etc/elasticsearch/jvm.options
sudo systemctl restart elasticsearch
sudo confluent start

# elasticsearch connect

sudo sed -i "s|topics=test-elasticsearch-sink|topics=fulltext.register|g" /etc/kafka-connect-elasticsearch/quickstart-elasticsearch.properties

cp /home/vagrant/laravel-presto-kafka-demo/kafka/connect-standalone.properties /etc/schema-registry/connect-standalone.properties
cp /home/vagrant/laravel-presto-kafka-demo/kafka/elasticsearch-connect.properties /etc/kafka-connect-elasticsearch/elasticsearch-connect.properties

sudo connect-standalone -daemon /etc/schema-registry/connect-standalone.properties /etc/kafka-connect-elasticsearch/elasticsearch-connect.properties
sudo confluent load elasticsearch-sink

# https://github.com/confluentinc/kafka-connect-elasticsearch/blob/master/docs/elasticsearch_connector.rst

curl -XPUT "$SELF_IP:9200/log.index/_mapping/logs?pretty" -H 'Content-Type: application/json' -d'
{
  "properties": {
    "created_at": {
      "type":     "text",
      "fielddata": true
    }
  }
}
'
