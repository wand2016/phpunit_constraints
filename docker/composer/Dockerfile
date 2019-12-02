FROM php:7.4-cli-alpine

# ----------------------------------------
# install composer
# ----------------------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer global require hirak/prestissimo

# ----------------------------------------
# install build-dependencies
# ----------------------------------------
RUN apk add --update-cache --no-cache --virtual=.build-dependencies ${PHPIZE_DEPS} tzdata

# ----------------------------------------
# install pcov for coverage reporting
# ----------------------------------------

RUN pecl install pcov
RUN docker-php-ext-enable pcov

# ----------------------------------------
# remove build-dependencies
# ----------------------------------------
RUN apk del .build-dependencies
