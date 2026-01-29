CREATE TABLE IF NOT EXISTS users (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

INSERT INTO users (name) VALUES
  ('caner'),
  ('durdu'),
  ('husniye'),
  ('mehmet')
ON CONFLICT (name) DO NOTHING;
