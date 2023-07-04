/*
Navicat PGSQL Data Transfer

Source Server         : servidor oficina
Source Server Version : 90409
Source Host           : 192.168.10.253:5432
Source Database       : dbproduccion
Source Schema         : adicional

Target Server Type    : PGSQL
Target Server Version : 90409
File Encoding         : 65001

Date: 2017-06-21 13:22:36
*/


-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS "adicional"."servicios";
CREATE TABLE "adicional"."servicios" (
"id" int4 DEFAULT nextval('"adicional".servicios_id_seq'::regclass) NOT NULL,
"fechaSolicitud" date,
"cuil" int4,
"solicitante" varchar(1) COLLATE "default",
"idComercio" int4,
"capacidad" int4,
"perSino" varchar(1) COLLATE "default",
"cantidad" int2,
"montado" int2,
"especial" int2,
"otros" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table servicios
-- ----------------------------
ALTER TABLE "adicional"."servicios" ADD PRIMARY KEY ("id");
