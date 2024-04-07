#!/bin/bash
set -eux
cd /home/ec2-user
aws ecr get-login-password --region us-west-2 | docker login --username AWS --password-stdin 972946504676.dkr.ecr.us-west-2.amazonaws.com
docker-compose pull -q
docker-compose up -d
docker-compose exec -u www-data api ash -c "php artisan migrate ; php artisan db:seed RoleAndPermissionSeeder"
docker system prune -f
