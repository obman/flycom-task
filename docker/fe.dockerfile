# base image
FROM node:23-alpine AS feinstaller

# setup bash
RUN apk add --no-cache bash

# set working directory
WORKDIR /app

# install and cache app dependencies
COPY /src/fe ./

RUN npm cache clean --force
RUN npm install

ENV HOST 0.0.0.0
EXPOSE 5173

CMD ["npm", "run", "dev"]