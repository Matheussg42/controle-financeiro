# Imagem de Origem
FROM node:13-alpine

#set our application folder as an environment variable
ENV APP_HOME /app

# Diretório de trabalho(é onde a aplicação ficará dentro do container).
WORKDIR $APP_HOME

#copy source files
COPY ./frontend $APP_HOME
COPY ./frontend/package.json /app/package.json

RUN npm install -g react-scripts

RUN yarn install --silent

CMD yarn run start
EXPOSE 3000