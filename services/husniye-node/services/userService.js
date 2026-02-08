import { pool } from "../src/db.js";

export async function findUserByEmail(email) {
  const r = await pool.query(
    "SELECT * FROM users WHERE email=$1",
    [email]
  );
  return r.rows[0];
}

export async function createUser(email, name, password_hash) {
  const r = await pool.query(
    "INSERT INTO users(email, name, password_hash) VALUES($1, $2, $3) RETURNING *",
    [email, name, password_hash]
  );
  return r.rows[0];
}
