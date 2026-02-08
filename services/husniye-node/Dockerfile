FROM node:20-alpine

WORKDIR /app

# package.json kopyala
COPY package*.json ./

# dependency kur
RUN npm install

# tüm dosyaları kopyala
COPY . .

# port aç
EXPOSE 3000

# server başlat
CMD ["node", "src/index.js"]
