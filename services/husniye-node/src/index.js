import express from "express";
import authRoutes from "../routes/auth.js";

const app = express();

app.use(express.json());
app.use("/auth", authRoutes);

app.listen(3000, () => console.log("API running"));
