-- Neoart Import Studio: staging tables. Запускать вручную на хостинге (миграций нет).
CREATE TABLE IF NOT EXISTS `neoart_import_run` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `catalog` VARCHAR(8) NOT NULL,
  `status` ENUM('running','done','error','canceled') NOT NULL DEFAULT 'running',
  `total` INT NOT NULL DEFAULT 0,
  `downloaded` INT NOT NULL DEFAULT 0,
  `failed` INT NOT NULL DEFAULT 0,
  `skipped` INT NOT NULL DEFAULT 0,
  `started_at` DATETIME NULL,
  `finished_at` DATETIME NULL,
  `error` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `neoart_item` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `run_id` INT NULL,
  `catalog` VARCHAR(8) NOT NULL,
  `vendor` VARCHAR(64) NOT NULL,
  `name` VARCHAR(255) NULL,
  `section_id` VARCHAR(32) NULL,
  `section_name` VARCHAR(255) NULL,
  `width_mm` INT NOT NULL DEFAULT 0,
  `widthwithout_mm` INT NOT NULL DEFAULT 0,
  `height_mm` INT NOT NULL DEFAULT 0,
  `price_base` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `price_chop` DECIMAL(10,2) NULL,
  `price_final` INT NOT NULL DEFAULT 0,
  `storage` INT NOT NULL DEFAULT 0,
  `raw_img` VARCHAR(255) NULL,
  `listimg` VARCHAR(255) NULL,
  `imgconst` VARCHAR(255) NULL,
  `cut_status` ENUM('none','auto_ok','auto_flagged','manual','error') NOT NULL DEFAULT 'none',
  `cut_flags` VARCHAR(128) NULL,
  `in_catalog` TINYINT(1) NOT NULL DEFAULT 0,
  `catalog_publicvendor` VARCHAR(32) NULL,
  `review_status` ENUM('pending','approved','rejected','published') NOT NULL DEFAULT 'pending',
  `approved_at` DATETIME NULL,
  `download_error` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  UNIQUE KEY `uniq_cat_vendor` (`catalog`,`vendor`),
  KEY `idx_catalog` (`catalog`),
  KEY `idx_review` (`review_status`),
  KEY `idx_cut` (`cut_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `neoart_import_log` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `run_id` INT NULL,
  `vendor` VARCHAR(64) NULL,
  `stage` ENUM('download','cut','publish') NOT NULL,
  `message` VARCHAR(512) NULL,
  `created_at` DATETIME NULL,
  KEY `idx_run` (`run_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
