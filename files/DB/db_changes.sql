___________01/04/2014______________________________

ALTER TABLE `voucher_master` ADD `source` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true, 2 for false'



CREATE TABLE IF NOT EXISTS `voucher_source_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



INSERT INTO `voucher_source_items` (`id`, `name`) VALUES
(1, 'All Customers'),
(2, 'Customer With TIN and CST'),
(3, 'All Suppliers'),
(4, 'Supplier With TIN and CST');



ALTER TABLE `voucher` ADD `voucher_source_item_id` INT( 11 ) NOT NULL ,
ADD `default_header` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `default_footer` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `default_currency` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `currency_id` INT( 11 ) NOT NULL ,
ADD `discount_rc_amt` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `frieght_demurge` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `round_off` TINYINT( 4 ) NOT NULL DEFAULT '2' COMMENT '1 for true , 2 for false',
ADD `no_of_copies` INT( 11 ) NOT NULL DEFAULT '1';


CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `default` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1 for true,2 for false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;




INSERT INTO `currency` (`id`, `name`, `symbol`, `default`) VALUES
(1, 'USD', '$', 2),
(2, 'EUR', '€', 2),
(3, 'INR', 'Rs.', 2),
(4, 'GBP', '£', 2);