package com.example.products;

import java.util.Map;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class PingController {

  private final JdbcTemplate jdbc;

  public PingController(JdbcTemplate jdbc) {
    this.jdbc = jdbc;
  }

  @GetMapping("/ping")
  public Map<String, Object> ping() {
    String name = System.getenv().getOrDefault("SERVICE_NAME", "caner");

    Map<String, Object> user = jdbc.queryForMap(
      "SELECT id, name FROM users WHERE name = ? LIMIT 1",
      name
    );

    return Map.of(
      "ok", true,
      "service", name,
      "db", Map.of("connected", true),
      "user", user
    );
  }
}

