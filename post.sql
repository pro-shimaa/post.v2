/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : post

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 04/02/2021 13:34:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for degree
-- ----------------------------
DROP TABLE IF EXISTS `degree`;
CREATE TABLE `degree`  (
  `degree_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`degree_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of degree
-- ----------------------------
INSERT INTO `degree` VALUES (1, 'ماجستير');
INSERT INTO `degree` VALUES (2, 'دكتوراة');
INSERT INTO `degree` VALUES (3, 'دبلومة');

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dept_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`dept_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, 'الهندسة المدنية بنين', '1');
INSERT INTO `department` VALUES (2, 'الهندسة الميكانيكية بنين', '1');
INSERT INTO `department` VALUES (3, 'الهندسة الكهربية بنين', '1');
INSERT INTO `department` VALUES (4, 'هندسة العمارة بنين', '1');
INSERT INTO `department` VALUES (5, 'هندسة التخطيط العمرانى بنين', '1');
INSERT INTO `department` VALUES (6, 'هندسة النظم والحاسبات بنين ', '1');
INSERT INTO `department` VALUES (7, 'هندسة التعدين والبترول بنين', '1');

-- ----------------------------
-- Table structure for fac_coun
-- ----------------------------
DROP TABLE IF EXISTS `fac_coun`;
CREATE TABLE `fac_coun`  (
  `coun_id` int(11) NOT NULL,
  `coun_no` int(11) NULL DEFAULT NULL,
  `coun_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`coun_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for grade
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade`  (
  `grade_id` int(11) NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`grade_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES (1, 'مقبول');
INSERT INTO `grade` VALUES (2, 'جيد');
INSERT INTO `grade` VALUES (3, 'جيد جدا');
INSERT INTO `grade` VALUES (4, 'جيد جدا مرتبة شرف');
INSERT INTO `grade` VALUES (5, 'امتياز');
INSERT INTO `grade` VALUES (6, 'امتياز مرتبة شرف');
INSERT INTO `grade` VALUES (7, 'A+');
INSERT INTO `grade` VALUES (8, 'A');
INSERT INTO `grade` VALUES (9, 'A-');
INSERT INTO `grade` VALUES (10, 'B+');
INSERT INTO `grade` VALUES (11, 'B');
INSERT INTO `grade` VALUES (12, 'B-');
INSERT INTO `grade` VALUES (13, 'C+');
INSERT INTO `grade` VALUES (14, 'C');

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history`  (
  `hist_id` int(11) NOT NULL AUTO_INCREMENT,
  `hist_date` datetime(0) NULL DEFAULT NULL,
  `reg_status` int(255) NULL DEFAULT NULL,
  `std_id` int(11) NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`hist_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `acc_lvl` int(11) NOT NULL,
  `lastlogin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'admin', 'admin@admin', 3, '2021-01-28 12:56:42pm', NULL, 'shimaa');
INSERT INTO `login` VALUES (2, 'shimaa', 'shimaa', 2, '2021-02-02 07:22:23pm', NULL, 'shimaaa');

-- ----------------------------
-- Table structure for prof
-- ----------------------------
DROP TABLE IF EXISTS `prof`;
CREATE TABLE `prof`  (
  `prof_id` int(11) NOT NULL AUTO_INCREMENT,
  `prof_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prof_degree_id` int(255) NULL DEFAULT NULL,
  `dept_id` int(11) NULL DEFAULT NULL,
  `work` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pass_word` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acc_lvl` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`prof_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prof
-- ----------------------------
INSERT INTO `prof` VALUES (1, 'dr.shehab gamaleldin', 1, 6, 'جامعة الازهر', '', '123', 4);
INSERT INTO `prof` VALUES (2, 'dr.ayman elshinawy', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (3, 'dr.abdelrahaman nasr', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (4, 'dr.mohamed ezz', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (5, 'dr.mohamed rohim', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (6, 'dr.ali rashed', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (7, 'dr.gamal tharwat', 1, 6, NULL, NULL, NULL, 4);
INSERT INTO `prof` VALUES (8, 'د.احمد عبدالعزيز', 5, 6, NULL, 'ahmed@aas.com', '123', 4);

-- ----------------------------
-- Table structure for prof_degree
-- ----------------------------
DROP TABLE IF EXISTS `prof_degree`;
CREATE TABLE `prof_degree`  (
  `prof_degree_id` int(11) NOT NULL AUTO_INCREMENT,
  `prof_degree` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`prof_degree_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prof_degree
-- ----------------------------
INSERT INTO `prof_degree` VALUES (1, 'معيد');
INSERT INTO `prof_degree` VALUES (2, 'مدرس مساعد');
INSERT INTO `prof_degree` VALUES (3, 'مدرس');
INSERT INTO `prof_degree` VALUES (4, 'استاذ مساعد');
INSERT INTO `prof_degree` VALUES (5, 'استاذ');
INSERT INTO `prof_degree` VALUES (6, 'استاذ متفرغ');

-- ----------------------------
-- Table structure for prof_std
-- ----------------------------
DROP TABLE IF EXISTS `prof_std`;
CREATE TABLE `prof_std`  (
  `std_prof_id` int(11) NOT NULL AUTO_INCREMENT,
  `std_id` int(11) NULL DEFAULT NULL,
  `prof_id` int(11) NULL DEFAULT NULL,
  `ne` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`std_prof_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject`  (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `std_id` int(11) NULL DEFAULT NULL,
  `subject_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sub_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for temp
-- ----------------------------
DROP TABLE IF EXISTS `temp`;
CREATE TABLE `temp`  (
  `std_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `degree_id` int(11) NULL DEFAULT NULL,
  `arabic_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `english_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `gender` int(255) NULL DEFAULT NULL,
  `birthdate` date NULL DEFAULT NULL,
  `birthplace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `phone_home` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone_mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_number` bigint(14) NULL DEFAULT NULL,
  `id_place` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jop` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `jop_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dept_id` int(255) NULL DEFAULT NULL,
  `special` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `grad_place` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `grade_id` int(11) NULL DEFAULT NULL,
  `grade_year` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `upload_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acc_lvl` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `update_std` int(2) NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `last_login` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `coun_no` int(11) NULL DEFAULT NULL,
  `coun_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ar_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `en_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sample` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fac_no` int(11) NULL DEFAULT NULL,
  `fac_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `upload_update_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jop_st` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` int(3) NULL DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `token` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`std_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for all_data
-- ----------------------------
DROP VIEW IF EXISTS `all_data`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `all_data` AS SELECT
degree.degree,
degree.degree_id,
department.dept_name,
department.dept_id,
grade.grade,
grade.grade_id,
temp.email,
temp.arabic_name,
temp.english_name,
temp.gender,
temp.birthdate,
temp.birthplace,
temp.country,
temp.state,
temp.region,
temp.address,
temp.phone_home,
temp.phone_mobile,
temp.id_number,
temp.id_place,
temp.id_date,
temp.jop,
temp.jop_st,
temp.jop_phone,
temp.special,
temp.grad_place,
temp.grade_year,
temp.upload_path,
temp.`password`,
temp.acc_lvl,
temp.`status`,
temp.std_id,
temp.`comment`,
temp.upload_update_path
FROM
temp
INNER JOIN degree ON temp.degree_id = degree.degree_id
INNER JOIN department ON temp.dept_id = department.dept_id
INNER JOIN grade ON temp.grade_id = grade.grade_id ; ;

-- ----------------------------
-- View structure for reg_cond
-- ----------------------------
DROP VIEW IF EXISTS `reg_cond`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `reg_cond` AS SELECT
temp.email as email,
temp.arabic_name as arname,
temp.english_name as enname,
temp.gender as gn,
temp.birthdate as bdate,
temp.birthplace as bplace,
temp.country as co,
temp.state as state,
temp.region as region,
temp.address as addr,
temp.phone_home as phone,
temp.phone_mobile as mobile,
temp.id_number as id,
temp.id_place as idp,
temp.id_date as idd,
temp.jop as jop,
temp.special as sp,
temp.dept_id,
temp.jop_phone as jopone,
temp.grad_place as gplace,
temp.grade_year as gyear,
temp.upload_path as up,
temp.`password` as pass,
history.hist_date as hdate,
history.`comment` as comm,
history.reg_status as args
FROM
temp
left JOIN history ON history.std_id=temp.std_id ; ;

SET FOREIGN_KEY_CHECKS = 1;
