FROM debian:sid

MAINTAINER Milan Felix Sulc <rkfelix@gmail.com>

RUN apt-get update && \
	apt-get upgrade -y && \
	apt-get install -y \
		curl \
		git \
		php7.1-cli \
		php7.1-mbstring \
		php7.1-intl \
		php7.1-json \
		php7.1-gd \
		php7.1-xml \
		php7.1-sqlite3 \
		php7.1-zip \
		php7.1-mysql \
		php7.1-tokenizer && \
	curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
#	cd /srv && \
#	composer create-project nette/sandbox /srv && \
	apt-get remove -y curl git && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY . /srv

WORKDIR /srv

CMD php -S 0.0.0.0:80 -t /srv/www