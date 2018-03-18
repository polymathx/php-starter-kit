rm -rf ./public/polymath.ini &&
echo 'Setting up public/polymath.ini...' &&
touch ./public/polymath.ini &&
echo 'api_key = ADDYOURKEY' >> ./public/polymath.ini &&
echo 'theme = default' >> ./public/polymath.ini &&
echo 'Config file setup. Please add your credentials to polymath.ini...'
