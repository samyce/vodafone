#!/bin/bash
#
# spustí kontejner podle dockerfile - pouze pro účely ladění dockerfile
#

cd "$(dirname "$0")"
set -ex

docker-compose up --build
