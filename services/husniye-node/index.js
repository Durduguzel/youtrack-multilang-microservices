import express from "express";

const app = express();

app.get("/ping", (req, res) => {
  res.json({ ok: true, service: "husniye", message: "Hello from Hüsniye (Node)" });
});

app.listen(3000, "0.0.0.0", () => {
  console.log("husniye listening on :3000");
});
