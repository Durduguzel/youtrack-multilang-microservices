import { findUserByEmail, createUser } from "../services/userService.js";

export async function login(req, res) {
  console.log("LOGIN BODY:", req.body);

  const { email } = req.body;

  const user = await findUserByEmail(email);

  if (!user) {
    console.log("User not found for email:", email);
    return res.status(404).json({ ok:false, message:"User yok" });
  }

  console.log("User found:", user);
  return res.json({ ok:true, user });
}


export async function register(req, res) {
  console.log("REGISTER HIT");

  const { email, name, password_hash } = req.body;

  const user = await createUser(email, name, password_hash);

  if(!user) {
    console.log("User creation failed for email:", email);
    return res.status(400).json({ ok:false, message:"User oluşturulamadı" });
  }
  
  console.log("User created:", user);
  res.json({ ok:true, user });
}
