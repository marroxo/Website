-- TGModz Database Schema
-- Run: mysql -u root -p tgmodz < sql/setup.sql
-- Or use install.php

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ── Categories ────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS categories (
  id         INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  name       VARCHAR(120)     NOT NULL,
  slug       VARCHAR(80)      NOT NULL,
  icon       VARCHAR(20)      NOT NULL DEFAULT '🎮',
  color      VARCHAR(20)      NOT NULL DEFAULT '#3b82f6',
  sort_order TINYINT UNSIGNED NOT NULL DEFAULT 0,
  is_active  TINYINT(1)       NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  UNIQUE KEY uq_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Products ──────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS products (
  id                INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  wc_id             INT UNSIGNED,
  category_id       INT UNSIGNED,
  name              VARCHAR(255)     NOT NULL,
  slug              VARCHAR(255)     NOT NULL,
  type              ENUM('variable','simple','external') NOT NULL DEFAULT 'simple',
  price             DECIMAL(10,2),
  sale_price        DECIMAL(10,2),
  short_description TEXT,
  description       TEXT,
  image_url         TEXT,
  is_in_stock       TINYINT(1)       NOT NULL DEFAULT 1,
  is_featured       TINYINT(1)       NOT NULL DEFAULT 0,
  is_active         TINYINT(1)       NOT NULL DEFAULT 1,
  badge_label       VARCHAR(50),
  badge_class       VARCHAR(50),
  license_key       TEXT,
  sort_order        SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  created_at        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_slug (slug),
  KEY idx_category (category_id),
  KEY idx_featured (is_featured),
  KEY idx_wc_id (wc_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Product Variations ────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS product_variations (
  id          INT UNSIGNED     NOT NULL AUTO_INCREMENT,
  product_id  INT UNSIGNED     NOT NULL,
  wc_id       INT UNSIGNED,
  name        VARCHAR(120)     NOT NULL,
  price       DECIMAL(10,2)    NOT NULL,
  sale_price  DECIMAL(10,2),
  is_in_stock TINYINT(1)       NOT NULL DEFAULT 1,
  license_key TEXT,
  sort_order  SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_product (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Users ─────────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  email         VARCHAR(255)  NOT NULL,
  password_hash VARCHAR(255),
  name          VARCHAR(120),
  is_guest      TINYINT(1)    NOT NULL DEFAULT 0,
  created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Orders ────────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS orders (
  id                INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  user_id           INT UNSIGNED,
  email             VARCHAR(255)  NOT NULL,
  stripe_session_id VARCHAR(255),
  status            ENUM('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  total             DECIMAL(10,2) NOT NULL,
  created_at        TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_stripe_session (stripe_session_id),
  KEY idx_user (user_id),
  KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Order Items ───────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS order_items (
  id             INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  order_id       INT UNSIGNED  NOT NULL,
  product_id     INT UNSIGNED  NOT NULL,
  variation_id   INT UNSIGNED,
  product_name   VARCHAR(255)  NOT NULL,
  variation_name VARCHAR(120),
  price          DECIMAL(10,2) NOT NULL,
  license_key    TEXT,
  PRIMARY KEY (id),
  KEY idx_order (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
