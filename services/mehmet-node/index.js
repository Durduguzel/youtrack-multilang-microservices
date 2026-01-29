import express from "express";
import pg from "pg";

const { Pool } = pg;

const SERVICE_NAME = process.env.SERVICE_NAME || "mehmet";
const DB_HOST = process.env.DB_HOST || "postgres";
const DB_PORT = Number(process.env.DB_PORT || 5432);
const DB_NAME = process.env.DB_NAME || "app";
const DB_USER = process.env.DB_USER || "app";
const DB_PASS = process.env.DB_PASS || "app";

const pool = new Pool({
  host: DB_HOST,
  port: DB_PORT,
  database: DB_NAME,
  user: DB_USER,
  password: DB_PASS,
});

const app = express();

app.get("/ping", async (req, res) => {
  try {
    const r = await pool.query("SELECT id, name FROM users WHERE name = $1 LIMIT 1", [SERVICE_NAME]);
    const user = r.rows[0] ?? null;

    res.json({
      ok: true,
      service: SERVICE_NAME,
      db: { connected: true },
      user,
    });
  } catch (e) {
    res.status(500).json({
      ok: false,
      service: SERVICE_NAME,
      db: { connected: false },
      error: String(e?.message || e),
    });
  }
});

app.listen(3000, "0.0.0.0", () => {
  console.log(`${SERVICE_NAME} listening on :3000`);
});
