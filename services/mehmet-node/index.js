import express from "express";

const app = express();

app.get("/ping", (req, res) => {
  res.json({ ok: true, service: "mehmet", message: "Hello from Mehmet (Node)" });
});

app.listen(3000, "0.0.0.0", () => {
  console.log("mehmet listening on :3000");
});
