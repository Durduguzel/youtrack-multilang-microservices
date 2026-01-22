# Polyglot Microservices Platform
*(Docker + API Gateway + Pure PHP UI)*

This repository contains a fully containerized **microservices platform** built entirely with Docker.
The project demonstrates how multiple languages and technologies (**Java, Node.js, PHP**) can coexist
within a single, coherent system using modern backend architecture principles.

---

## Goals of the Project

- Build a real microservice-based architecture from scratch
- Use multiple programming languages in the same system
- Practice API Gateway, service-to-service communication and internal auth
- Integrate PostgreSQL, Redis and RabbitMQ
- Apply event-driven architecture
- Implement minimum observability (Request ID propagation)
- Run everything **without installing runtimes on the host machine**

---

## Architecture Overview

### Entry Point
- **gateway (Nginx)**
  - Single entrypoint for the entire system
  - Path-based routing to backend services

### UI
- **frontend (Pure PHP)**
  - Simple test panel
  - Communicates with backend services only via the gateway

### Backend Services

#### Users Service (Java)
- Technology: Java, Spring Boot
- Database: PostgreSQL
- Responsibilities:
  - User creation
  - User listing

Endpoints:
- `GET  /api/users/ping`
- `GET  /api/users/users`
- `POST /api/users/users`

```json
{ "name": "Alice" }
```

---

#### Products Service (Java)
- Technology: Java, Spring Boot
- Database: PostgreSQL
- Responsibilities:
  - Product creation and listing
  - SKU-based product validation
  - Used by Orders Service for validation

Endpoints:
- `GET  /api/products/ping`
- `GET  /api/products/products`
- `POST /api/products/products`

```json
{
  "sku": "P1",
  "name": "Keyboard",
  "price": 199.90
}
```

- `GET /api/products/products/sku/{sku}`

---

#### Orders Service (Node.js)
- Technology: Node.js, Express
- Database: PostgreSQL
- Messaging: RabbitMQ (publisher)
- Responsibilities:
  - Order creation
  - Product validation via Products Service
  - Event publishing (`order.created`)

Endpoints:
- `GET  /api/orders/ping`
- `POST /api/orders/orders`

```json
{
  "customer": "Product",
  "items": [{ "sku": "P1", "qty": 1 }]
}
```

---

#### Tags Service (Node.js)
- Technology: Node.js, Express
- Cache: Redis
- Messaging: RabbitMQ (consumer)
- Responsibilities:
  - Consume `order.created` events
  - Maintain order counter
  - Provide statistics endpoint

Endpoints:
- `GET /api/tags/ping`
- `GET /api/tags/stats`

---

## Infrastructure Services

- **PostgreSQL** – persistent storage
- **Redis** – counters / cache
- **RabbitMQ** – event bus

---

## Create Order Flow

1. UI → Gateway → Orders Service
2. Orders Service → Products Service (HTTP + internal auth)
3. Orders Service → PostgreSQL
4. Orders Service → RabbitMQ (`order.created`)
5. Tags Service consumes event
6. Redis counter incremented
7. UI reads stats from Tags Service

---

## Internal Authentication

- All backend services require:
  ```
  Authorization: Bearer dev-internal-token
  ```
- UI currently sends the token intentionally for testing purposes
- Can later be moved entirely to gateway header injection

---

## Minimum Observability (Request ID)

- Gateway generates `X-Request-Id`
- Propagated across all services
- Forwarded during service-to-service calls
- Included in RabbitMQ event payloads
- Exposed in Tags Service stats response

This enables end-to-end request correlation **without logging infrastructure**.

---

## Project Structure

```
.
├── docker-compose.yml
├── gateway/
│   └── nginx.conf
├── frontend-php/
│   └── public/index.php
└── services/
    ├── users-java/
    ├── products-java/
    ├── orders-node/
    └── tags-node/
```

---

## Running with Docker

### Requirements
- Docker Desktop
- Docker Compose
- Git

Check:
```bash
docker --version
docker compose version
```

---

### Start All Services
```bash
docker compose up --build
```

UI:
- http://localhost/

---

### Stop Services
```bash
docker compose down
```

---

### Reset Everything (including database)
```bash
docker compose down -v
docker compose up --build
```

---

### Rebuild a Single Service
```bash
docker compose up -d --build orders-service
```

---

### View Logs
```bash
docker compose logs -f orders-service
docker compose logs -f products-service
docker compose logs -f users-service
docker compose logs -f tags-service
docker compose logs -f gateway
```

---

## Smoke Test

1. Open http://localhost/
2. Create a product
3. Create an order
4. Check tags stats

If all steps work, the system is running correctly.

---

## Final Notes

This project is intentionally designed as a **foundation**.
It can be extended with:
- Gateway-level auth
- Rate limiting
- Circuit breakers
- Distributed tracing
- Real frontend

Current state already demonstrates strong backend architecture fundamentals.
