rm -rf ./public/polymath.ini &&
echo 'Setting up public/polymath.ini...' &&
touch ./public/polymath.ini &&
mkdir ./public/cache &&
echo '[site_config]' >> ./public/polymath.ini &&
echo 'api_key = ADDYOURKEY' >> ./public/polymath.ini &&
echo 'theme = default' >> ./public/polymath.ini &&
echo 'cache[time] = 3600' >> ./public/polymath.ini &&
echo 'cache[path] = ./cache/' >> ./public/polymath.ini &&
echo "models[1] = '/blog'" >> ./public/polymath.ini &&
echo "models[2] = '/'" >> ./public/polymath.ini &&
echo 'Config file setup. Please add your credentials to polymath.ini...'
