FROM node:13-alpine AS BUILD_IMAGE

WORKDIR /app

COPY ./frontend/package.json ./frontend/yarn.lock ./

RUN yarn --frozen-lockfile

COPY ./frontend .

FROM node:13-alpine

WORKDIR /app

COPY --from=BUILD_IMAGE /app/ ./

EXPOSE 3000

CMD yarn run start