CREATE DATABASE work;

USE work;

CREATE TABLE Depart
(
	DID CHAR(4) NOT NULL,
	Dname CHAR(40),
	CONSTRAINT PK_DID PRIMARY KEY (DID)
);

CREATE TABLE Wtype
(
	TID CHAR(4) NOT NULL,
	Tname CHAR(40),
	CONSTRAINT PK_TID PRIMARY KEY (TID)
);

CREATE TABLE Worker
(
	WID CHAR(8) NOT NULL,
	DID CHAR(4) NOT NULL,
	TID CHAR(4) NOT NULL,
	Wname CHAR(20),
	Wsex CHAR(2) DEFAULT('男'),
	Wbirth DATE,
	InTime DATE,
	basW int default (0),
	InAge as DATEDIFF(year,InTime,GETDATE()),
	CONSTRAINT PK_WID PRIMARY KEY (WID),
	CONSTRAINT FK_DID FOREIGN KEY(DID) REFERENCES Depart(DID),
	CONSTRAINT FK_TID FOREIGN KEY(TID) REFERENCES Wtype(TID)
);

CREATE TABLE Wsta
(
	DID CHAR(4) NOT NULL,
	TID CHAR(4) NOT NULL,
	welW int default (0),
	rewW int default (0),
	InsW int default (0),
	funW int default (0),
	CONSTRAINT PK_DID_TID PRIMARY KEY (DID,TID),
	CONSTRAINT FK_WDID FOREIGN KEY(DID) REFERENCES Depart(DID),
	CONSTRAINT FK_WTID FOREIGN KEY(TID) REFERENCES Wtype(TID)
);

CREATE TABLE Wage
(
	WID CHAR(8) NOT NULL,
	Wtime DATE,
	basW int,
	welW int,
	rewW int,
	InsW int,
	funW int,
	total  as (basW + welW + rewW + InsW + funW),
	CONSTRAINT FK_WIsD FOREIGN KEY(WID) REFERENCES Worker(WID),
	CONSTRAINT PK_WID_WT PRIMARY KEY (WID,Wtime)
);

CREATE VIEW gongzi(WID,日期,姓名,基本工资,福利补贴,奖励工资,失业保险,住房基金,实际工资)
AS
SELECT 
	Wage.WID, 
	Wtime as 日期,
	Wname as 姓名,
	Wage.basW as 基本工资,
	welW as 福利补贴,
	rewW as 奖励工资,
	InsW as 失业保险,
	funW as 住房基金,
	total as 实际工资
FROM Wage INNER JOIN Worker
ON Wage.WID = Worker.WID;

CREATE VIEW bumen(Dname ,Tname,welW ,rewW ,InsW ,funW )
AS
SELECT 
	Dname ,
	Tname,
	welW ,
	rewW ,
	InsW ,
	funW 
FROM Wsta jOIN Depart
ON Wsta.DID = Depart.DID
INNER JOIN Wtype
ON Wtype.TID = Wtype.TID;

create trigger del_worker
on Worker
     instead of  delete
as
BEGIN
    DELETE FROM Wage 
	WHERE WID in (SELECT WID FROM Deleted);
	DELETE FROM Worker
	WHERE WID in (SELECT WID FROM Deleted);
END;

create proc fgz
as
begin
	INSERT Wage SELECT WID,GETDATE(),basW, welW ,rewW ,InsW ,funW
	FROM 
		Worker inner join Wsta ON Worker.DID = Wsta.DID AND Worker.TID = Wsta.TID
end;

create proc shengri
as
begin
	UPDATE Worker SET basW += 100 WHERE MONTH(GETDATE()) = MONTH(Wbirth) AND DAY(GETDATE()) = DAY(GETDATE())
end;