# Imagem de Origem
FROM node:13-alpine

# Diretório de trabalho(é onde a aplicação ficará dentro do container).
WORKDIR /app

#copy source files
COPY ./frontend /app

RUN yarn install --silent

CMD yarn run start
EXPOSE 3000