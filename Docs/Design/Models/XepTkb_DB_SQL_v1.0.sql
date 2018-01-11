/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11-01-18 2:37:05 PM                          */
/*==============================================================*/


drop table if exists HOCKI;

drop table if exists LOP_HOC_PHAN;

drop table if exists NAMHOC;

drop table if exists NGUOI_DUNG;

drop table if exists TKB;

drop table if exists XEP_TKB;

/*==============================================================*/
/* Table: HOCKI                                                 */
/*==============================================================*/
create table HOCKI
(
   HOCKI                varchar(2) not null,
   primary key (HOCKI)
);

/*==============================================================*/
/* Table: LOP_HOC_PHAN                                          */
/*==============================================================*/
create table LOP_HOC_PHAN
(
   MAHP                 varchar(10) not null,
   TENHP                varchar(100) not null,
   KIHIEU               varchar(5) not null,
   THU                  varchar(1) not null,
   TIETBD               varchar(2) not null,
   SOTIET               varchar(2) not null,
   PHONG                varchar(10) not null,
   SISO                 varchar(3) not null,
   TINCHI               varchar(2) not null,
   TUANHOC              varchar(20) not null,
   primary key (MAHP, KIHIEU, THU, TIETBD)
);

/*==============================================================*/
/* Table: NAMHOC                                                */
/*==============================================================*/
create table NAMHOC
(
   NAMHOC               varchar(5) not null,
   primary key (NAMHOC)
);

/*==============================================================*/
/* Table: NGUOI_DUNG                                            */
/*==============================================================*/
create table NGUOI_DUNG
(
   MSSV                 varchar(8) not null,
   HOTEN                varchar(50) not null,
   EMAIL                varchar(50) not null,
   MKHAU                varchar(20) not null,
   MALOP                varchar(8) not null,
   KICHHOAT             varchar(1) default 'N',
   primary key (MSSV)
);

/*==============================================================*/
/* Table: TKB                                                   */
/*==============================================================*/
create table TKB
(
   ID                   smallint not null,
   MSSV                 varchar(8) not null,
   primary key (ID)
);

/*==============================================================*/
/* Table: XEP_TKB                                               */
/*==============================================================*/
create table XEP_TKB
(
   ID                   smallint not null,
   MSSV                 varchar(8) not null,
   MAHP                 varchar(10) not null,
   KIHIEU               varchar(5) not null,
   THU                  varchar(1) not null,
   TIETBD               varchar(2) not null,
   NAMHOC               varchar(5) not null,
   HOCKI                varchar(2) not null,
   primary key (ID, MSSV, MAHP, KIHIEU, THU, TIETBD, NAMHOC, HOCKI)
);

alter table TKB add constraint FK_TKB_NGDUNG foreign key (MSSV)
      references NGUOI_DUNG (MSSV) on delete restrict on update restrict;

alter table XEP_TKB add constraint FK_HOCKI_XEPTKB foreign key (HOCKI)
      references HOCKI (HOCKI) on delete restrict on update restrict;

alter table XEP_TKB add constraint FK_LOPHP_XEPTKB foreign key (MAHP, KIHIEU, THU, TIETBD)
      references LOP_HOC_PHAN (MAHP, KIHIEU, THU, TIETBD) on delete restrict on update restrict;

alter table XEP_TKB add constraint FK_NAMHOC_XEPTKB foreign key (NAMHOC)
      references NAMHOC (NAMHOC) on delete restrict on update restrict;

alter table XEP_TKB add constraint FK_NGUOI_XEPTKB foreign key (MSSV)
      references NGUOI_DUNG (MSSV) on delete restrict on update restrict;

alter table XEP_TKB add constraint FK_TKB_XEPTKB foreign key (ID)
      references TKB (ID) on delete restrict on update restrict;

