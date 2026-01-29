# YouTrack Polyglot Microservices Platform
*(Docker + API Gateway + Pure PHP UI)*

This repository contains a **team-based, polyglot microservices template** designed for collaborative development.
Each developer works on an isolated service using a different technology stack, while sharing a common gateway and UI.

The project is intentionally kept **simple and dependency-free by default** so that every developer can start coding immediately.
Infrastructure components (PostgreSQL, Redis, RabbitMQ) are included **as optional building blocks** and can be enabled when needed.

---

## Project Goals

- Provide a **ready-to-use microservices template** for team development
- Enable parallel development with **clear service ownership**
- Demonstrate polyglot backend development (**Java, Node.js, PHP**)
- Practice API Gateway and service isolation
- Allow optional infrastructure integration (DB / Cache / Messaging)
- Run everything via Docker without installing runtimes locally

---

## Architecture Overview

### Entry Point
- **gateway (Nginx)**
  - Single entrypoint for the entire system
  - Path-based routing to backend services
  - No changes required when adding new endpoints to existing services

### UI
- **frontend (Pure PHP)**
  - Simple handover panel
  - One page per developer
  - Communicates with backend services only via the gateway

### Backend Services (People-Oriented)

Each service is owned by a single developer and can evolve independently.

#### Caner Service (Java)
- Technology: Java, Spring Boot
- Folder: `services/caner-java`
- Purpose:
  - Caner’s personal service
  - Starts with a simple `/ping` endpoint
  - Can later integrate DB or messaging if required

Endpoint:
- `GET /api/caner/ping`

---

#### Durdu Service (Java)
- Technology: Java, Spring Boot
- Folder: `services/durdu-java`
- Purpose:
  - Durdu’s personal service
  - Independent development space

Endpoint:
- `GET /api/durdu/ping`

---

#### Hüsniye Service (Node.js)
- Technology: Node.js, Express
- Folder: `services/husniye-node`
- Purpose:
  - Hüsniye’s personal service
  - Lightweight Node.js playground

Endpoint:
- `GET /api/husniye/ping`

---

#### Mehmet Service (Node.js)
- Technology: Node.js, Express
- Folder: `services/mehmet-node`
- Purpose:
  - Mehmet’s personal service
  - Can later consume events or use Redis if needed

Endpoint:
- `GET /api/mehmet/ping`

---

## Infrastructure Services (Optional)

Infrastructure services are **present but commented out** in `docker-compose.yml`.

They can be enabled by uncommenting when required by a service.

- **PostgreSQL** – persistent storage
- **Redis** – cache / counters
- **RabbitMQ** – messaging / events

---

## Routing Convention

All external traffic goes through the gateway:

```
/api/caner/*    → caner service
/api/durdu/*   → durdu service
/api/husniye/* → husniye service
/api/mehmet/*  → mehmet service
```

As long as a developer stays within their own prefix,
**no gateway changes are required**.

---

## Project Structure

```
.
├── docker-compose.yml
├── gateway/
│   └── nginx.conf
├── frontend-php/
│   └── public/
│       ├── index.php
│       ├── caner.php
│       ├── durdu.php
│       ├── husniye.php
│       └── mehmet.php
└── services/
    ├── caner-java/
    ├── durdu-java/
    ├── husniye-node/
    └── mehmet-node/
```

---

## Running the Project

### Requirements
- Docker Desktop
- Docker Compose
- Git

Verify installation:
```bash
docker --version
docker compose version
```

---

### Start the System

```bash
docker compose up --build
```

UI:
- http://localhost/

---

### Stop the System

```bash
docker compose down
```

---

### Reset Everything (including volumes)

```bash
docker compose down -v
docker compose up --build
```

---

### Rebuild a Single Service

```bash
docker compose up -d --build caner
docker compose up -d --build durdu
docker compose up -d --build husniye
docker compose up -d --build mehmet
```

---

### View Logs

```bash
docker compose logs -f gateway
docker compose logs -f frontend
docker compose logs -f caner
docker compose logs -f durdu
docker compose logs -f husniye
docker compose logs -f mehmet
```

---

## Smoke Test

1. Open http://localhost/
2. Click your name
3. Press **Ping Service**
4. Confirm JSON response

If all services respond, the system is running correctly.

---

### PostgreSQL Credentials

To connect via pgAdmin or etc.

```bash
Host:     localhost
Port:     15432
Database: app
User:     app
Password: app
```

---

## How Developers Should Start

1. Go to your service folder under `services/`
2. Implement your endpoints freely
3. Enable database or messaging only if your service needs it
4. Avoid modifying gateway unless a **new service** is added

---

## Final Notes

This repository is intentionally a **starting point**, not a finished product.

It provides:
- Clear ownership boundaries
- Safe parallel development
- A realistic microservices foundation

From here, the system can grow naturally based on real requirements.
