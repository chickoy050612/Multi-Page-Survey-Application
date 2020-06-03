drop database if exists lamp1_survey;
create database lamp1_survey;

grant all privileges on lamp1_survey.* to 'lamp1_survey'@'localhost' identified by '!Survey9!';

use lamp1_survey

CREATE TABLE `participants` (
  `part_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_fullname` varchar(128) NOT NULL,
  `part_age` int(11) NOT NULL,
  `part_student` char(1) NOT NULL,
  PRIMARY KEY (`part_id`)
);


CREATE TABLE `responses` (
  `resp_id` int(11) NOT NULL AUTO_INCREMENT,
  `resp_part_id` int(11) NOT NULL,
  `resp_product` varchar(100) NOT NULL,
  `resp_how_purchased` varchar(50) NOT NULL,
  `resp_satisfied` int(11) NOT NULL,
  `resp_recommend` varchar(10) NOT NULL,
  PRIMARY KEY (`resp_id`)
)
