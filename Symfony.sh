path=/var/www/html/Symfony
function cache
{
	sudo rm -R $path/app/cache/*
}

function param
{
	if [ $# -ne 1 ] 
	then
		echo "usage : param nom"
	else 
		php $path/app/console doctrine:generate:entities yoPlatformBundle:$1
	fi
}

function dump
{
	php $path/app/console doctrine:schema:update --dump-sql
}

function sql
{
	php $path/app/console doctrine:schema:update --force
}

function entity
{
	php $path/app/console generate:doctrine:entity	
}

function bundle
{
	php $path/app/console generate:bundle
}
