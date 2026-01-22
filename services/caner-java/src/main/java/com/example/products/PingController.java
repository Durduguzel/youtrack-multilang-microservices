package com.example.products;

import java.util.Map;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class PingController {

  @GetMapping("/ping")
  public Map<String, Object> ping() {
    return Map.of(
      "ok", true,
      "service", "caner",
      "message", "Hello from Caner (Java)"
    );
  }
}
