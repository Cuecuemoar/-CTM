CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) DEFAULT NULL,
    `first_name` VARCHAR(255) DEFAULT NULL,
    `last_name` VARCHAR(255) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `opt_in` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
)
