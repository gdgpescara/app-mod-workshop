USE image_catalog;

-- Popolamento tabella users con un amministratore e alcuni utenti normali
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$il9iJULRoOJWqY4L9PmOGeL32WJnLdPYWjtWtS3KnxWBXxWK6dQnG', 'admin'),  -- Password: admin123
('user1', '$2y$10$UE4I6iAbZ5KvadGShTJMcelhb9s5DC0drsjC4wElkcrRZf0.BUMgW', 'user'),   -- Password: user123
('user2', '$2y$10$hGhR9fA4Qb5v0dgVpfoLOuKz9EQxTwSjJvTWhVcwlTvc5K/kLpFdO', 'user');   -- Password: user123

-- Popolamento tabella images con alcune immagini iniziali
INSERT INTO images (user_id, filename, inappropriate) VALUES
(2, 'uploads/image1.png', 0),
(2, 'uploads/image2.png', 0),
(3, 'uploads/image3.png', 1),  -- Immagine segnalata come inappropriata
(3, 'uploads/image4.png', 0);