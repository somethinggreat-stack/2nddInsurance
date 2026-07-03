-- =====================================================================
--  Patrick Yasso Insurance — Database setup for cPanel (phpMyAdmin)
-- ---------------------------------------------------------------------
--  HOW TO RUN:
--   1. cPanel -> phpMyAdmin
--   2. Select the database  quotesha_patrick  (left sidebar)
--   3. Open the "SQL" tab
--   4. Paste EVERYTHING below and click "Go"
--
--  This site only needs ONE table at runtime: `leads`.
--  (Sessions/cache are file-based; admin login uses .env — no users table.)
-- =====================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type`         VARCHAR(255) NOT NULL DEFAULT 'contact',
  `name`         VARCHAR(255) NOT NULL,
  `email`        VARCHAR(255) DEFAULT NULL,
  `phone`        VARCHAR(255) DEFAULT NULL,
  `city`         VARCHAR(255) DEFAULT NULL,
  `zip`          VARCHAR(255) DEFAULT NULL,
  `interests`    LONGTEXT DEFAULT NULL,
  `message`      TEXT DEFAULT NULL,
  `data`         LONGTEXT DEFAULT NULL,
  `status`       VARCHAR(255) NOT NULL DEFAULT 'new',
  `source`       VARCHAR(255) DEFAULT NULL,
  `ip_address`   VARCHAR(255) DEFAULT NULL,
  `user_agent`   VARCHAR(512) DEFAULT NULL,
  `contacted_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at`   TIMESTAMP NULL DEFAULT NULL,
  `updated_at`   TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_type_index` (`type`),
  KEY `leads_status_index` (`status`),
  KEY `leads_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
