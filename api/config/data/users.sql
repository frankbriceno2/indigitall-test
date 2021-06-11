/*
-- Query: SELECT * FROM indigitall.users
LIMIT 0, 1000

-- Date: 2021-06-09 15:19
*/
INSERT INTO `users` (`id_user`,`fullname`,`email`,`password`,`language`,`latitude`,`longitude`,`created_at`,`update_at`) VALUES (1,'User One','user_one@yopmail.com','b46bac3ec2fa4b483d8be0a194b16bfa','ES',40.4163,-3.6934,'2021-06-08 15:57:26','2021-06-08 15:57:26');
INSERT INTO `users` (`id_user`,`fullname`,`email`,`password`,`language`,`latitude`,`longitude`,`created_at`,`update_at`) VALUES (2,'User Two','user_two@yopmail.com','c8c38778e485d70372eb2240c31a0b8f','ES',40.4163,-3.6934,'2021-06-08 15:57:49','2021-06-08 15:57:49');
INSERT INTO `users` (`id_user`,`fullname`,`email`,`password`,`language`,`latitude`,`longitude`,`created_at`,`update_at`) VALUES (3,'User Three','user_three@yopmail.com','76a9d6268b3df28c359a090db46ee6b2','ES',40.4163,-3.6934,'2021-06-08 15:58:42','2021-06-08 15:58:42');
INSERT INTO `users` (`id_user`,`fullname`,`email`,`password`,`language`,`latitude`,`longitude`,`created_at`,`update_at`) VALUES (4,'User Four','user_four@yopmail.com','42b27b641ae7eab937bb244b643f4f95','ES',40.4163,-3.6934,'2021-06-08 15:59:17','2021-06-08 15:59:17');

INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('1', '2');
INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('1', '3');
INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('1', '4');
INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('4', '1');
INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('4', '2');
INSERT INTO `indigitall`.`friends` (`id_user`, `id_user_friend`) VALUES ('4', '3');