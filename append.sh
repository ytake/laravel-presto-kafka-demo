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
cp -r /home/vagrant/laravel-presto-example/presto/etc/ /home/vagrant/presto-server-0.185/etc
./presto-server-0.185/bin/launcher restart

# install presto-cli
wget https://repo1.maven.org/maven2/com/facebook/presto/presto-cli/0.185/presto-cli-0.185-executable.jar
mv presto-cli-0.185-executable.jar presto
chmod 755 presto
chown -R vagrant:vagrant presto
./presto --server 127.0.0.1:8080


# elasticsearch

echo "network.host: 0.0.0.0" > "/etc/elasticsearch/elasticsearch.yml"
sudo systemctl restart elasticserach

sudo confluent start
