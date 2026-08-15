-- Base de données — Site musical Angela Volcimus Louis
-- Importer via phpMyAdmin ou : mysql -u root -p < sql/schema.sql

CREATE DATABASE IF NOT EXISTS angela_music
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE angela_music;

CREATE TABLE IF NOT EXISTS concerts (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title         VARCHAR(180) NOT NULL,
  venue         VARCHAR(180) NOT NULL,
  city          VARCHAR(120) NOT NULL,
  event_date    DATE NOT NULL,
  ticket_url    VARCHAR(255) DEFAULT NULL,
  status        ENUM('available', 'soldout', 'cancelled') NOT NULL DEFAULT 'available',
  is_published  TINYINT(1) NOT NULL DEFAULT 1,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tracks (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title         VARCHAR(180) NOT NULL,
  genre         VARCHAR(80) NOT NULL,
  duration      VARCHAR(10) DEFAULT NULL,
  album         VARCHAR(120) DEFAULT NULL,
  audio_url     VARCHAR(255) DEFAULT NULL,
  spotify_url   VARCHAR(255) DEFAULT NULL,
  apple_url     VARCHAR(255) DEFAULT NULL,
  youtube_url   VARCHAR(255) DEFAULT NULL,
  sort_order    INT NOT NULL DEFAULT 0,
  is_published  TINYINT(1) NOT NULL DEFAULT 1,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS messages (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(120) NOT NULL,
  email         VARCHAR(180) NOT NULL,
  subject       VARCHAR(180) NOT NULL,
  message       TEXT NOT NULL,
  type          ENUM('fan', 'booking', 'press') NOT NULL DEFAULT 'fan',
  is_read       TINYINT(1) NOT NULL DEFAULT 0,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS gallery (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title         VARCHAR(180) NOT NULL,
  image_path    VARCHAR(255) NOT NULL,
  category      ENUM('scene', 'studio', 'portrait', 'backstage') NOT NULL DEFAULT 'portrait',
  sort_order    INT NOT NULL DEFAULT 0,
  is_published  TINYINT(1) NOT NULL DEFAULT 1,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO concerts (title, venue, city, event_date, ticket_url, status) VALUES
('Soirée Soul & Gospel', 'Salle Pleyel', 'Paris', '2026-09-12', 'https://example.com', 'available'),
('Voix Classiques — Récital', 'Opéra de Lyon', 'Lyon', '2026-10-03', 'https://example.com', 'available'),
('Night of R&B', 'Le Trianon', 'Paris', '2026-11-18', 'https://example.com', 'soldout'),
('Worship Experience', 'Grand Temple', 'Bruxelles', '2026-12-05', 'https://example.com', 'available');

INSERT INTO tracks (title, genre, duration, album, sort_order, spotify_url, apple_url, youtube_url) VALUES
('Velvet Prayer', 'Gospel · R&B', '3:42', 'Lumière Intérieure', 1, '#', '#', '#'),
('Aria of Silence', 'Classique', '4:18', 'Lumière Intérieure', 2, '#', '#', '#'),
('Midnight Honey', 'R&B', '3:55', 'Lumière Intérieure', 3, '#', '#', '#'),
('Grace Rising', 'Gospel', '4:01', 'Singles', 4, '#', '#', '#'),
('Nocturne pour Toi', 'Classique · Soul', '5:12', 'Singles', 5, '#', '#', '#');
