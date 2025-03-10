<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

WARNING - 2025-03-10 00:07:00 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:07:01 --> 1054 - Unknown column 't1.rank' in 'field list' [ SELECT `t0`.`id` AS `t0_c0`, `t0`.`position` AS `t0_c1`, `t0`.`sb` AS `t0_c2`, `t0`.`bb` AS `t0_c3`, `t0`.`ante` AS `t0_c4`, `t0`.`memo` AS `t0_c5`, `t0`.`created_at` AS `t0_c6`, `t0`.`updated_at` AS `t0_c7`, `t0`.`deleted_at` AS `t0_c8`, `t1`.`id` AS `t1_c0`, `t1`.`play_id` AS `t1_c1`, `t1`.`type` AS `t1_c2`, `t1`.`rank` AS `t1_c3`, `t1`.`suit` AS `t1_c4`, `t1`.`created_at` AS `t1_c5` FROM `plays` AS `t0` LEFT JOIN `cards` AS `t1` ON (`t0`.`id` = `t1`.`play_id`) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 00:15:27 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:24:38 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:24:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:26:58 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:32:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:32:22 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:32:22 --> Notice - Undefined variable: rank_options in /var/www/html/my_fuel_project/fuel/app/views/plays/create.php on line 23
WARNING - 2025-03-10 00:37:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:37:09 --> Warning - Invalid argument supplied for foreach() in /var/www/html/my_fuel_project/fuel/app/views/plays/create.php on line 23
WARNING - 2025-03-10 00:39:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:39:57 --> Warning - Invalid argument supplied for foreach() in /var/www/html/my_fuel_project/fuel/app/views/plays/create.php on line 23
WARNING - 2025-03-10 00:40:39 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:46:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:47:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:48:36 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:48:51 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 00:49:40 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:49:40 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', null, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 00:58:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:58:57 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', null, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 00:59:02 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:59:02 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', null, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 00:59:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:59:25 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', null, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 00:59:53 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 00:59:53 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', null, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 01:04:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 01:04:27 --> 1292 - Incorrect datetime value: '1741536267' for column 'created_at' at row 1 [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES ('BB', '10', '20', '20', 'テストデータ', 1741536267, null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 01:05:52 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:05:53 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:05:58 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:06:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:06:14 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:17:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:17:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:23:44 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:39:49 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:39:51 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:40:55 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 01:40:55 --> 1048 - Column 'created_at' cannot be null [ INSERT INTO `cards` (`play_id`, `type`, `card_rank`, `suit`, `created_at`) VALUES (6, 'hand', 'K', 'spade', null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 01:45:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 01:45:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:16:59 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:20:53 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:57:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:57:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:58:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 03:58:20 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 03:58:21 --> Error - Call to undefined method Fuel\Core\Response::json() in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 71
WARNING - 2025-03-10 04:02:08 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 05:10:02 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 05:10:19 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 05:10:32 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 05:10:33 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 05:25:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 05:25:25 --> Compile Error - Cannot declare class Fuel\App\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 243
WARNING - 2025-03-10 05:28:50 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 05:28:50 --> Compile Error - Cannot declare class Fuel\App\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 05:28:52 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 05:28:52 --> Compile Error - Cannot declare class Fuel\App\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 05:28:54 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 05:28:54 --> Compile Error - Cannot declare class Fuel\App\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:34:52 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:34:53 --> Compile Error - Cannot declare class Fuel\App\Classes\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:36:16 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:36:16 --> Compile Error - Cannot declare class Fuel\App\Classes\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:36:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:36:17 --> Compile Error - Cannot declare class Fuel\App\Classes\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:36:31 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:36:31 --> Compile Error - Cannot declare class Fuel\App\Classes\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:41:04 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:41:04 --> Compile Error - Cannot declare class App\Classes\Controller\Controller_Plays, because the name is already in use in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 241
WARNING - 2025-03-10 07:44:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:44:13 --> Warning - The use statement with non-compound name 'DateTime' has no effect in /var/www/html/my_fuel_project/fuel/app/classes/controller/plays.php on line 12
WARNING - 2025-03-10 07:45:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:45:12 --> Warning - get_class() expects parameter 1 to be object, null given in /var/www/html/my_fuel_project/fuel/core/classes/security.php on line 241
WARNING - 2025-03-10 07:46:49 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:46:49 --> Warning - get_class() expects parameter 1 to be object, null given in /var/www/html/my_fuel_project/fuel/core/classes/security.php on line 241
WARNING - 2025-03-10 07:46:50 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:46:51 --> Warning - get_class() expects parameter 1 to be object, null given in /var/www/html/my_fuel_project/fuel/core/classes/security.php on line 241
WARNING - 2025-03-10 07:57:40 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 07:57:40 --> Error - There is no security.output_filter defined in your application config file in /var/www/html/my_fuel_project/fuel/core/classes/security.php on line 75
WARNING - 2025-03-10 08:01:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 08:01:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:32:16 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:32:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:38:31 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:45:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:45:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:45:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:56:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 13:56:29 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:03:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:15:00 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:31:33 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:35:07 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:36:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:36:14 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:39:39 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 14:42:37 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:01:38 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:02:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:03:33 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:07:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:08:45 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:14:20 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:22:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:26:04 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:26:05 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:29:55 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:29:56 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:30:03 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 15:30:03 --> Error - The requested view could not be found: plays/view.php in /var/www/html/my_fuel_project/fuel/core/classes/view.php on line 440
WARNING - 2025-03-10 15:30:28 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-03-10 15:30:29 --> 1048 - Column 'position' cannot be null [ INSERT INTO `plays` (`position`, `sb`, `bb`, `ante`, `memo`, `created_at`, `updated_at`, `deleted_at`) VALUES (null, null, null, null, null, '2025-03-10 15:30:29', null, null) ] in /var/www/html/my_fuel_project/fuel/core/classes/database/mysqli/connection.php on line 292
WARNING - 2025-03-10 15:43:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-03-10 15:43:49 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
