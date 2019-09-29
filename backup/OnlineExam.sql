/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : app_onlineexam

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-05-18 09:45:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `DeadLine` datetime NOT NULL,
  `Context` varchar(255) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '计算机组成原理', '2017-03-19 21:13:15', '2017-03-20 21:13:23', '计算机组成原理是一门课程');
INSERT INTO `course` VALUES ('2', '软件工程', '2017-03-19 21:13:27', '2017-03-20 21:13:31', '软件工程也是一门课程');
INSERT INTO `course` VALUES ('3', '大学外语', '2017-03-19 20:53:17', '2017-03-20 20:53:22', '大学外语也是一门课程');
INSERT INTO `course` VALUES ('4', '专业英语', '2017-03-19 20:53:17', '2017-03-20 20:53:22', '专业英语也是一门课程');

-- ----------------------------
-- Table structure for course_question
-- ----------------------------
DROP TABLE IF EXISTS `course_question`;
CREATE TABLE `course_question` (
  `CourseID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  PRIMARY KEY (`CourseID`,`QuestionID`),
  KEY `QuestionID` (`QuestionID`),
  CONSTRAINT `CourseID` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `QuestionID` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course_question
-- ----------------------------
INSERT INTO `course_question` VALUES ('2', '1');
INSERT INTO `course_question` VALUES ('2', '2');
INSERT INTO `course_question` VALUES ('2', '3');
INSERT INTO `course_question` VALUES ('2', '4');
INSERT INTO `course_question` VALUES ('1', '5');
INSERT INTO `course_question` VALUES ('1', '6');
INSERT INTO `course_question` VALUES ('1', '7');
INSERT INTO `course_question` VALUES ('1', '8');
INSERT INTO `course_question` VALUES ('1', '32');
INSERT INTO `course_question` VALUES ('2', '33');
INSERT INTO `course_question` VALUES ('2', '34');
INSERT INTO `course_question` VALUES ('2', '35');
INSERT INTO `course_question` VALUES ('2', '36');
INSERT INTO `course_question` VALUES ('2', '37');
INSERT INTO `course_question` VALUES ('2', '38');

-- ----------------------------
-- Table structure for course_student
-- ----------------------------
DROP TABLE IF EXISTS `course_student`;
CREATE TABLE `course_student` (
  `CourseID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Score` int(3) NOT NULL,
  `IsAnswered` int(1) NOT NULL,
  PRIMARY KEY (`CourseID`,`StudentID`),
  KEY `course_student_ibfk_2` (`StudentID`),
  CONSTRAINT `course_student_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`),
  CONSTRAINT `course_student_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `user` (`SchoolID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course_student
-- ----------------------------
INSERT INTO `course_student` VALUES ('1', '13008037', '30', '1');
INSERT INTO `course_student` VALUES ('2', '13008037', '90', '1');
INSERT INTO `course_student` VALUES ('2', '13008038', '50', '1');
INSERT INTO `course_student` VALUES ('2', '13008888', '10', '1');

-- ----------------------------
-- Table structure for course_teacher
-- ----------------------------
DROP TABLE IF EXISTS `course_teacher`;
CREATE TABLE `course_teacher` (
  `CourseID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  PRIMARY KEY (`CourseID`,`TeacherID`),
  KEY `course_teacher_ibfk_2` (`TeacherID`),
  CONSTRAINT `course_teacher_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`),
  CONSTRAINT `course_teacher_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `user` (`SchoolID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course_teacher
-- ----------------------------
INSERT INTO `course_teacher` VALUES ('2', '13000000');

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(255) NOT NULL,
  `ChoiceA` varchar(255) NOT NULL,
  `ChoiceB` varchar(255) NOT NULL,
  `ChoiceC` varchar(255) NOT NULL,
  `ChoiceD` varchar(255) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `Score` int(3) NOT NULL,
  PRIMARY KEY (`QuestionID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('1', '软件生命周期一般包括：软件开发期和软件运行期，下述（）不是软件开发期所应包含的内容。', 'A.需求分析', 'B.结构设计', 'C.程序编制', 'D.软件维护', 'D', '10');
INSERT INTO `question` VALUES ('2', '软件是一种逻辑产品，它的开发主要是（）。', 'A.研制', 'B.拷贝', 'C.再生产', 'D.复制', 'A', '10');
INSERT INTO `question` VALUES ('3', '以文档作为驱动，适合于软件需求很明确的软件项目的生存周期模型是（）。', 'A.喷泉模型', 'B.增量模型', 'C.瀑布模型', 'D.螺旋模型 ', 'C', '10');
INSERT INTO `question` VALUES ('4', '在软件生存周期中，（）阶段必须要回答的问题是“要解决的问题是做什么？”。', 'A.详细设计', 'B.详细设计', 'C.概要设计', 'D.软件测试', 'B', '10');
INSERT INTO `question` VALUES ('5', '世界上首先实现存储程序的电子数字计算机是____。', 'A.ENIAC ', 'B.UNIVAC ', 'C.EDVAC', 'D.EDSAC', 'A', '10');
INSERT INTO `question` VALUES ('6', '计算机科学的奠基人是____。', 'A.查尔斯.巴贝奇', 'B.图灵', 'C.阿塔诺索夫', 'D.冯.诺依曼', 'B', '10');
INSERT INTO `question` VALUES ('7', '计算机所具有的存储程序和程序原理是____提出的。', 'A.图灵', 'B.布尔', 'C.冯•诺依曼', 'D.爱因斯坦', 'C', '10');
INSERT INTO `question` VALUES ('8', '1946年世界上有了第一台电子数字计算机，奠定了至今仍然在使用的计算机____。', 'A.外型结构', 'B.总线结构', 'C.存取结构', 'D.体系结构', 'D', '10');
INSERT INTO `question` VALUES ('32', '1946年第一台计算机问世以来，计算机的发展经历了4个时代，它们是____', 'A.低档计算机、中档计算机、高档计算机、手提计算机', 'B.微型计算机、小型计算机、中型计算机、大型计算机', 'C.组装机、兼容机、品牌机、原装机', 'D.电子管计算机、晶体管计算机、小规模集成电路计算机、大规模及超大规模集成电路计算机', 'D', '10');
INSERT INTO `question` VALUES ('33', '软件产品与物质产品有很大区别，软件产品是一种(）产品', 'A.有形', 'B.消耗', 'C.逻辑', 'D.文档', 'C', '10');
INSERT INTO `question` VALUES ('34', '软件特性中，一个软件能再次用于其他相关应用的程度称为（）。', 'A.可移植性', 'B.可重用性', 'C.容错性', 'D.可适应性', 'B', '10');
INSERT INTO `question` VALUES ('35', '软件特性中，允许对软件进行修改而不增加其复杂性指的是（）。', 'A.可修改性', 'B.可适应性', 'C.可维护性', 'D.可移植性', 'A', '10');
INSERT INTO `question` VALUES ('36', '软件特性中，根据软件需求对软件设计、程序进行正向追踪，或根据程序、软件设计对软件需求进行逆向追踪的能力指的是（）。', 'A.可理解性', 'B.可互操作性', 'C.可追踪性', 'D.可维护性', 'C', '10');
INSERT INTO `question` VALUES ('37', '下列选项中，属于详细设计阶段的任务的是(）。', 'A.组装测试计划', 'B.单元测试计划', 'C.初步用户手册', 'D.验收测试计划', 'B', '10');
INSERT INTO `question` VALUES ('38', '下列选项中，属于概要设计阶段的任务的是（）。', 'A.组装测试计划', 'B.单元测试计划', 'C.初步用户手册', 'D.验收测试计划', 'A', '10');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolID` int(8) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TelNo` varchar(11) NOT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `IsTeacher` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `SchoolID` (`SchoolID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '13008038', '方明', '123456', '18502410459', '', '0');
INSERT INTO `user` VALUES ('2', '13000000', '方明', '456789', '18502410459', '', '1');
INSERT INTO `user` VALUES ('4', '13008037', '方明', '123456', '18502510459', null, '0');
INSERT INTO `user` VALUES ('5', '13008888', '方明', '123456', '18502418999', null, '0');
