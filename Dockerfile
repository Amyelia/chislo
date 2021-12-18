FROM nginx:latest
COPY ./default.conf /etc/nginx/conf.d/
COPY ./index.php /test_folder