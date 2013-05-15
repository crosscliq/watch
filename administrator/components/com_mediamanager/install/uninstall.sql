-- -----------------------------------------------------
-- HOW TO USE THIS FILE:
-- Replace all instances of #_ with your prefix
-- In PHPMYADMIN or the equiv, run the entire SQL
-- -----------------------------------------------------

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

drop table if exists `#__mediamanager_addresses`;
drop table if exists `#__mediamanager_carts`;
drop table if exists `#__mediamanager_categories`;
drop table if exists `#__mediamanager_config`;
drop table if exists `#__mediamanager_countries`;
drop table if exists `#__mediamanager_currencies`;
drop table if exists `#__mediamanager_geozones`;
drop table if exists `#__mediamanager_geozonetypes`;
drop table if exists `#__mediamanager_manufacturers`;
drop table if exists `#__mediamanager_ordercoupons`;
drop table if exists `#__mediamanager_orderhistory`;
drop table if exists `#__mediamanager_orderinfo`;
drop table if exists `#__mediamanager_orderitems`;
drop table if exists `#__mediamanager_orderitemattributes`;
drop table if exists `#__mediamanager_orderpayments`;
drop table if exists `#__mediamanager_orders`;
drop table if exists `#__mediamanager_ordershippings`;
drop table if exists `#__mediamanager_orderstates`;
drop table if exists `#__mediamanager_ordertaxclasses`;
drop table if exists `#__mediamanager_ordertaxrates`;
drop table if exists `#__mediamanager_ordervendors`;
drop table if exists `#__mediamanager_productattributeoptions`;
drop table if exists `#__mediamanager_productattributes`;
drop table if exists `#__mediamanager_productcategoryxref`;
drop table if exists `#__mediamanager_productcomments`;
drop table if exists `#__mediamanager_productcommentshelpfulness`;
drop table if exists `#__mediamanager_productdownloadlogs`;
drop table if exists `#__mediamanager_productdownloads`;
drop table if exists `#__mediamanager_productfiles`;
drop table if exists `#__mediamanager_productprices`;
drop table if exists `#__mediamanager_productquantities`;
drop table if exists `#__mediamanager_productrelations`;
drop table if exists `#__mediamanager_productreviews`;
drop table if exists `#__mediamanager_products`;
drop table if exists `#__mediamanager_productvotes`;
drop table if exists `#__mediamanager_shippingmethods`;
drop table if exists `#__mediamanager_shippingrates`;
drop table if exists `#__mediamanager_subscriptions`;
drop table if exists `#__mediamanager_subscriptionhistory`;
drop table if exists `#__mediamanager_taxclasses`;
drop table if exists `#__mediamanager_taxrates`;
drop table if exists `#__mediamanager_userinfo`;
drop table if exists `#__mediamanager_zonerelations`;
drop table if exists `#__mediamanager_zones`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;