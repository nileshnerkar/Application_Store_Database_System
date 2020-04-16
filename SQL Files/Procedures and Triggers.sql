SELECT count(*) FROM employee
WHERE emp_id like '%M'

SELECT * FROM Categories
insert into  Application_Documents(application_id, version_id, icon, screenshot) 
values ('101','5',(SELECT * FROM OPENROWSET(BULK N'C:\Users\Anuja\Desktop\IS\DBDS\Final Project\whatsapp.jpg', SINGLE_BLOB) AS Icon),
(SELECT * FROM OPENROWSET(BULK N'‪C:\Users\Anuja\Desktop\IS\DBDS\Final Project\whatsappScreenshot.jpg', SINGLE_BLOB) AS Screenshot));

INSERT INTO Categories(CategoryName, CategoryPicture) 
Values ('Another Category', (SELECT * FROM OPENROWSET(BULK N'C:\Temp\AnotherCategory.jpg', SINGLE_BLOB) AS CategoryImage))
SELECT * FROM applications

CREATE TABLE Admin_Credentials
(credentials_id INT,
username VARCHAR(10),
password VARCHAR(20))

insert into Admin_Credentials values ('1','admin','admin');

SELECT * FROM Admin_Credentials WHERE username = 'sid77' and password = 'sid77'

SELECT * FROM Admin_Credentials
SELECT * FROM User_Account_Details
SELECT * FROM Users;
insert into Users values ('10001','Peter','Shaw','3/2/1992','8168375673','9168775673','20');
insert into Users values (NEXT VALUE FOR USerSeq,'Nick','Ded','3/3/1991','8168372673','9168775683','50');

DECLARE @id uniqueidentifier
SET @id = NEWID()
insert into User_Account_Details values ('20001','sid77',HASHBYTES('SHA2_512', 'sid77' + CAST(@id AS VARCHAR(64))), @id,'sedhkan@gmail.com','1','1','10001');
INSERT INTO dbo.[User] (LoginName, PasswordHash, Salt, FirstName, LastName)
        VALUES(@pLogin, HASHBYTES('sid77', 'sid77' + CAST(@id AS BINARY(36))), @id, @pFirstName, @pLastName)
20001	sid77	CAte#wqs$A	sedhkan@gmail.com	1	1	10001
SELECT * FROM User_Account_Details



	DELETE FROM User_Account_Details WHERE account_id = '20001';
GO
CREATE PROCEDURE InsertUserCredentials
	@user_name VARCHAR(12),
	@password VARCHAR(64),
	@email_address VARCHAR(18),
	@is_verified BIT,
	@is_active BIT,
	@user_id INT,
    @responseMessage NVARCHAR(250) OUTPUT
AS
BEGIN
    SET NOCOUNT ON

    DECLARE @id uniqueidentifier
	SET @id = NEWID()
    BEGIN TRY
	
		INSERT INTO User_Account_Details (account_id,user_name, password, [password_hash], email_address, is_verified, is_active, user_id)
		VALUES (NEXT VALUE FOR UserAccountDetailsSeq, @user_name, HASHBYTES('SHA2_512', @password + CAST(@id AS VARCHAR(64))),
		 @id,@email_address,@is_verified,@is_active,@user_id);

        SET @responseMessage='Success'

    END TRY
    BEGIN CATCH
        SET @responseMessage=ERROR_MESSAGE() 
    END CATCH
END

DECLARE @responseMessage NVARCHAR(250)

EXEC InsertUserCredentials
	@user_name = N'karan',
	@password = N'123',
	@email_address = N'karan@gmail.com',
	@is_verified = N'1',
	@is_active = N'1',
	@user_id = N'10002',
    @responseMessage = @responseMessage OUTPUT

SELECT * FROM User_Account_Details
SELECT * FROM Category_Applications
SELECT * FROM Country_Language_Support
GO        
ALTER PROCEDURE LoginUSer

    @user_name VARCHAR(12),
    @password VARCHAR(64),
    @responseMessage NVARCHAR(250)='' OUTPUT
AS
BEGIN
    SET NOCOUNT ON
	DECLARE @account_id INT

    IF EXISTS (SELECT TOP 1 account_id FROM dbo.User_Account_Details WHERE user_name=@user_name)
    BEGIN
        SET @account_id = (SELECT account_id FROM dbo.User_Account_Details WHERE user_name = @user_name 
		AND password = HASHBYTES('SHA2_512', @password + CAST(password_hash AS VARCHAR(64))))

       IF(@account_id IS NULL)
           SET @responseMessage='Incorrect password'
       ELSE
           SET @responseMessage='User successfully logged in'
    END
    ELSE
       SET @responseMessage='Invalid login'
END

DECLARE	@responseMessage nvarchar(250)

--Correct login and password
EXEC	LoginUSer
		@user_name = N'sid77',
		@password = N'sid77',
		@responseMessage = @responseMessage OUTPUT

SELECT	@responseMessage as N'@responseMessage'

GO        
Create PROCEDURE LoginUserNew

    @user_name VARCHAR(12),
    @password VARCHAR(64)
AS
BEGIN
    SET NOCOUNT ON
	DECLARE @account_id INT

    IF EXISTS (SELECT TOP 1 account_id FROM dbo.User_Account_Details WHERE user_name=@user_name)
    BEGIN
        SET @account_id = (SELECT account_id FROM dbo.User_Account_Details WHERE user_name = @user_name 
		AND password = HASHBYTES('SHA2_512', @password + CAST(password_hash AS VARCHAR(64))))

       IF(@account_id IS NULL)
           BEGIN
				RAISERROR('Input  value cannot be NULL',1,1)
			END
    END
END

EXEC	LoginUserNew
		@user_name = N'sid77',
		@password = N'sid77' 
SELECT TOP 1 account_id FROM dbo.User_Account_Details WHERE user_name= 'sid77';

(SELECT account_id FROM dbo.User_Account_Details WHERE user_name ='sid77' 
		AND password = HASHBYTES('SHA2_512', 'sid77' + CAST(password_hash AS VARCHAR(64))))


insert into Admin_Credentials values ('1','admin','admin');

SELECT * FROM Application_Documents
SELECT * FROM Applications_Archive
SELECT * FROM Users
SELECT * FROM Applications
SELECT * FROM Categories
SELECT * FROM Application_Reviews
insert into Application_Reviews values ('101','5','10001','superb!!','It is one of the best application','3/2/2011','3.90',
'It can be improved with respect to UI','0');
insert into Application_Reviews values ('101','6','10001','awesome!!','It is one of the awesome application','3/2/2011','5.00',
'It can be improved with respect to design','0');

It is one of the best application for the business	3/2/2011	3.90		0

CREATE VIEW Category_Applications
AS SELECT DISTINCT A.name, AVG(AR.rating) AS Ratings,C.category_name AS Category FROM Categories C
INNER JOIN Application_Categories AC
ON (C.category_id = AC.category_id)
INNER JOIN Applications A
ON (AC.application_id = A.application_id)
AND (AC.version_id = A.version_id)
INNER JOIN Application_Reviews AR
ON (AR.application_id = A.application_id)
AND (AR.version_id = A.version_id)
GROUP BY A.name,C.category_name

	SELECT * FROM Category_Applications
	WHERE Category = 'social'




GO
CREATE TRIGGER tr_applications_backup
ON Applications
FOR UPDATE 
AS 
DECLARE @application_id INT
DECLARE @version_id FLOAT
DECLARE @name VARCHAR(20)
DECLARE @description VARCHAR(20)
DECLARE @version_fix VARCHAR(50)
DECLARE @created_date DATE
DECLARE @updated_date DATE
DECLARE @price FLOAT
DECLARE @age_restriction CHAR(4)
DECLARE @is_verified BIT
DECLARE @is_advertised BIT
DECLARE @application_files_id INT
DECLARE @app_support_id INT
DECLARE @developer_id INT

DECLARE @msg VARCHAR(255)
DECLARE @user VARCHAR(10)
DECLARE @machine_name VARCHAR(10)
DECLARE @employee_id VARCHAR(10)

DECLARE @job_id_old VARCHAR(10)
DECLARE @job_id_new VARCHAR(10)
DECLARE @job_level_old VARCHAR(10)
DECLARE @job_level_new VARCHAR(10)

SET @user = (SELECT SYSTEM_USER)
SET @machine_name = (SELECT HOST_NAME())

SELECT @job_id_old = CAST((SELECT job_id FROM DELETED) AS VARCHAR(10))
SELECT @job_id_new = CAST((SELECT job_id FROM INSERTED) AS VARCHAR(10))
SELECT @job_level_old = CAST((SELECT job_lvl FROM DELETED) AS VARCHAR(10))
SELECT @job_level_new = CAST((SELECT job_lvl FROM INSERTED) AS VARCHAR(10))
SELECT @employee_id = (SELECT emp_id FROM DELETED)


IF (@job_id_old != @job_id_new)
	SET @msg = ('PROMOTION of the employee having id ' + @employee_id + 'has been is done from ' + @job_id_old + ' to ' + @job_id_new)
	ELSE IF (@job_level_old != @job_level_new)
	SET @msg = ('LEVEL CHANGE of the employee having id ' + @employee_id + 'has been is done from ' + @job_level_old + ' to ' + @job_level_new)
		
INSERT INTO Logger_New(msg,sys_user,machine_name,time_Stamp ) VALUES (@msg, @user, @machine_name, getdate())

INSERT INTO Applications (application_id,version_id,name,description,version_fix,created_date,updated_date,price,age_restriction,
is_verified,is_advertised,application_files_id,app_support_id,developer_id)
VALUES (@application_id,@version_id, @name,@description,@version_fix,@created_date,@updated_date, @price,@age_restriction,
@is_verified, @is_advertised, @application_files_id,@app_support_id, @developer_id)



INSERT INTO Applications_Archive SELECT * FROM Applications WHERE application_id = '102'




SELECT * FROM Users
SELECT * FROM Applications
SELECT * FROM Categories;

insert into Categiories
SELECT * FROM Developers;
SELECT * FROM Application_Compatibility;
SELECT * FROM Application_Categories;
SELECT * FROM Application_Reviews;
SELECT * FROM User_Account_Details;
SELECT * FROM Users;


GO        
ALTER PROCEDURE LoginUser

    @user_name VARCHAR(12),
    @password VARCHAR(64),
    @responseMessage NVARCHAR(250)='' OUTPUT
AS
BEGIN
    SET NOCOUNT ON
	DECLARE @account_id INT

    IF EXISTS (SELECT TOP 1 account_id FROM dbo.User_Account_Details WHERE user_name=@user_name)
    BEGIN
        SET @account_id = (SELECT account_id FROM dbo.User_Account_Details WHERE user_name = @user_name 
		AND password = HASHBYTES('SHA2_512', @password + CAST(password_hash AS VARCHAR(64))))

       IF(@account_id IS NULL)
           SET @responseMessage='Incorrect password'
       ELSE
           SET @responseMessage='User successfully logged in'
    END
    ELSE
       SET @responseMessage='Invalid login'
END



SELECT * FROM Applications_Supports

CREATE SEQUENCE USerSeq 
    AS int  
    START WITH 10001  
    INCREMENT BY 1 ;

CREATE SEQUENCE seqApplications
    AS int  
    START WITH 106  
    INCREMENT BY 1 ;

ALTER VIEW Category_Applications
AS 

SELECT ROUND(AVG(AR.rating),2) AS Ratings,C.category_name AS Category FROM Categories C
INNER JOIN Application_Categories AC
ON (C.category_id = AC.category_id)
INNER JOIN Applications A
ON (AC.application_id = A.application_id)
AND (AC.version_id = A.version_id)
INNER JOIN Application_Reviews AR
ON (AR.application_id = A.application_id)
AND (AR.version_id = A.version_id)
WHERE A.name = 'whatsapp';
GROUP BY A.name, C.category_name

SELECT name, Ratings FROM Category_Applications
WHERE name = 'Whatsapp';


GO
ALTER PROCEDURE dbo.validateAndInsertApplications (@application_id INT,@version_id FLOAT, @name VARCHAR(20),
				@description VARCHAR(20),@version_fix VARCHAR(50),@created_date DATE ,@updated_date DATE, @price FLOAT,@age_restriction CHAR(4),
				@is_verified BIT, @is_advertised BIT, @application_files_id INT,@app_support_id INT, @developer_id INT)
AS
BEGIN
Declare @nameInserted varchar(20)
		(SELECT top 1 @nameInserted =  name FROM Applications WHERE application_id = @application_id)
Declare @appID INT
		 SELECT top 1 @appID =  application_id FROM Applications WHERE name = @name

		IF 
		@name != @nameInserted

		BEGIN
				RAISERROR('Application name is already present, and it has to be unique',1,1)
		END
		ELSE
		BEGIN
			INSERT INTO Applications (application_id,version_id,name,description,version_fix,created_date,updated_date,price,age_restriction,
						is_verified,is_advertised,application_files_id,app_support_id,developer_id)
			VALUES (@application_id,@version_id, @name,@description,@version_fix,@created_date,@updated_date, @price,@age_restriction,
						@is_verified, @is_advertised, @application_files_id,@app_support_id, @developer_id)
		END
END
GO

EXEC validateAndInsertApplications @application_id = '100',@version_id ='1' , @name = 'WhatsApp',
						@description = 'It is used to connect with people and chat, video call, etc.',
						@version_fix = 'icon bug fixed',
						@created_date = '2014-4-4', @updated_date = '2018-4-4', 
						@price = '40',@age_restriction = NULL ,@is_verified = '1', @is_advertised ='1', 
						@application_files_id = '1235',@app_support_id = '1235', @developer_id = '1002'


insert into Applications values ('107','1.00','Linkin','professional','',
'7/8/2014','9/18/2018','40','','1','1','1232','1234','1001');

SELECT * FROM Applications
DELETE FROM Applications WHERE version_id IN ('1','8')

ALTER TRIGGER trgArchiveApplications 
ON Applications
AFTER INSERT AS
BEGIN

DECLARE @count INT
DECLARE @inserted_application_id INT
		SELECT @inserted_application_id = (SELECT application_id FROM INSERTED)
		(SELECT  @count =  count(application_id) FROM Applications WHERE application_id = @inserted_application_id)

		IF 
		@count = 6
			BEGIN
			INSERT INTO Applications_Archive SELECT TOP (1) application_id,version_id,name,description,
			version_fix,created_date,updated_date,price,age_restriction,application_files_id,app_support_id,developer_id 
			FROM Applications WHERE application_id = @inserted_application_id
			END
		ELSE
			BEGIN
				RAISERROR('No insertion to applications archive',1,1)
			END
END
SELECT * FROM Applications

ALTER TRIGGER trgLog 
ON Applications
AFTER DELETE AS
BEGIN

DECLARE @count INT
DECLARE @inserted_application_id INT
		SELECT @inserted_application_id = (SELECT application_id FROM INSERTED)
		(SELECT  @count =  count(application_id) FROM Applications WHERE application_id = @inserted_application_id)

		IF 
		@count = 6
			BEGIN
			INSERT INTO Applications_Archive SELECT TOP (1) application_id,version_id,name,description,
			version_fix,created_date,updated_date,price,age_restriction,application_files_id,app_support_id,developer_id 
			FROM Applications WHERE application_id = @inserted_application_id
			END
		ELSE
			BEGIN
				RAISERROR('No insertion to applications archive',1,1)
			END
END

SELECT * FROM Applications

GO
ALTER TRIGGER trgArchiveApplications 
ON Applications
AFTER INSERT AS
BEGIN

DECLARE @count INT
DECLARE @inserted_application_id INT
		SELECT @inserted_application_id = (SELECT application_id FROM INSERTED)
		(SELECT  @count =  count(application_id) FROM Applications WHERE application_id = @inserted_application_id)

		IF (@count = 6)
			BEGIN
			INSERT INTO Applications_Archive SELECT TOP (1) application_id,version_id,name,description,
			version_fix,created_date,updated_date,price,age_restriction,application_files_id,app_support_id,developer_id 
			FROM Applications WHERE application_id = @inserted_application_id
			
				RAISERROR('Data insertion to applications archive successfull',1,1)
			END
END
GO
Create TRIGGER trgLogger
ON Applications
AFTER DELETE AS
BEGIN

DECLARE @inserted_application_id INT
		SELECT @inserted_application_id = (SELECT application_id FROM DELETED)
		
			BEGIN

			INSERT INTO Applications_Archive SELECT TOP (1) application_id,version_id,name,description,
			version_fix,created_date,updated_date,price,age_restriction,application_files_id,app_support_id,developer_id 
			FROM Applications WHERE application_id = @inserted_application_id
			
			END
END

DELETE FROM Applications WHERE application_id = '116';