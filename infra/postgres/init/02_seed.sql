INSERT INTO users (email, password_hash, name)
VALUES
  ('caner@example.com', 'dummy_hash', 'caner'),
  ('durdu@example.com', 'dummy_hash', 'durdu'),
  ('husniye@example.com', 'dummy_hash', 'husniye'),
  ('mehmet@example.com', 'dummy_hash', 'mehmet')
ON CONFLICT (email) DO NOTHING;
