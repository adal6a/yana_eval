CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    KEY `email_user_index` (`email`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user_activities` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `uid` int(11) NOT NULL,
    `message_text` mediumtext NOT NULL,
    `message_from` varchar(100) NOT NULL,
    `datetime` varchar(100) NOT NULL,
    `timestamp` varchar(100) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `activities_user_index` (`uid`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;