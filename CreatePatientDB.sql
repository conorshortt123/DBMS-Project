Drop database if exists PatientsDB;
Show databases;
create database PatientsDB CHARACTER SET utf8 COLLATE UTF8_GENERAL_CI ;
Use PatientsDB;
Show tables;
Drop table if exists patient;

Drop table if exists patient;
create table patient (
  pid tinyint unsigned NOT NULL auto_increment ,
  fname varchar(45) NOT NULL, -- maximum column length is 45 characters
  lname varchar(45) NOT NULL,
  dob varchar(45) NOT NULL,
  email varchar(45) NOT NULL,
  address varchar(45) NOT NULL,	
  appid tinyint unsigned, -- appointment id foreign key
  billid tinyint unsigned, -- bill id foreign key
  patientpic_path varchar(45) NOT NULL,
  PRIMARY KEY (pid)
  ) Engine=InnoDB;
  
Drop table if exists appointment;
create table appointment (
  appid tinyint unsigned NOT NULL auto_increment , -- appointment id 
  pid tinyint unsigned NOT NULL, -- patient id
  appDate varchar(45) NOT NULL,
  sid tinyint NOT NULL, -- specialist id
  PRIMARY KEY (appid)
  ) Engine=InnoDB;
 
Drop table if exists specialist;
 create table specialist (
  sid tinyint unsigned NOT NULL auto_increment ,  -- specialist id
  specializeIn ENUM ('Orthodontist', 'Periodontics', 'Prosthodontics', 'Endodontics') NOT NULL,
  fname varchar(45) NOT NULL,
  lname varchar(45) NOT NULL,
  PRIMARY KEY (sid)
  ) Engine=InnoDB;
  
Drop table if exists treatment;
 create table treatment (
  tid tinyint unsigned NOT NULL auto_increment ,  -- specialist id
  sid tinyint unsigned NOT NULL, -- specialist id foreign key
  treatment varchar(45) NOT NULL,
  status ENUM ('Ongoing', 'Complete') NOT NULL,	
  PRIMARY KEY (tid)
  ) Engine=InnoDB;
  
Drop table if exists bill;
 create table bill (
  bid tinyint unsigned NOT NULL auto_increment ,  -- bill id primary key
  pid tinyint unsigned NOT NULL, -- patient id foreign key
  paymentid tinyint unsigned NOT NULL, -- payment id foreign key
  treatmentid tinyint unsigned NOT NULL, -- treatment id foreign key
  cost double NOT NULL,	
  PRIMARY KEY (bid)
 ) Engine=InnoDB;
 
Drop table if exists payment;
  create table payment (
  paymentid tinyint unsigned NOT NULL auto_increment ,  -- payment id pk
  bid tinyint unsigned NOT NULL, -- bill id foreign key
  method ENUM ('Cash', 'Cheque', 'Mastercard', 'Visa', 'Installments') NOT NULL,	
  status ENUM ('Due', 'Pending' ,'Paid') NOT NULL,	
  PRIMARY KEY (paymentid)
 ) Engine=InnoDB;

INSERT INTO patient (fname, lname, dob, email, address, appid, billid, patientpic_path) VALUES
('Conor','Shortt', '24/05/1998','conorshortt@gmail.com', '7 killascaul, Esker, Athenry', 1, 1, '/patients/cat1.jpg'),
('David','Shortt', '25/04/1995','davidshortt@gmail.com', '7 killascaul, Esker, Athenry', 2, 2, '/patients/cat2.jpg'),
('Lucia','Shortt', '02/03/1994', 'luciashortt@gmail.com', '7 killascaul, Esker, Athenry', 3, 3, '/patients/cat3.jpg'),
('Christina','Shortt', '14/02/1993','christinashortt@gmail.com', '7 killascaul, Esker, Athenry', 4, 4, '/patients/cat4.jpg'),
('Joseph','Shortt', '08/08/2000','josephshortt@gmail.com', '7 killascaul, Esker, Athenry', 5, 5, '/patients/cat5.jpg'),
('Joshua','Shortt', '29/05/2003','joshuashortt@gmail.com', '7 killascaul, Esker, Athenry', 6, 6, '/patients/cat6.jpg'),
('Cathy','Shortt', '20/04/1946','cathyshortt@gmail.com', '7 killascaul, Esker, Athenry', 7, 7, '/patients/cat7.jpg')
;

INSERT INTO appointment (appid, pid, appDate, sid) VALUES
(1, 1, '21/03/2020', 1),
(2, 2, '23/03/2020', 2),
(3, 3, '22/03/2020', 3),
(4, 4, '20/03/2020', 4),
(5, 5, '19/03/2020', 5),
(6, 6, '15/03/2020', 6),
(7, 7, '11/03/2020', 7)
;

INSERT INTO bill (bid, pid, paymentid, treatmentid, cost) VALUES
(1, 1, 1, 1, 100.00),
(2, 2, 2, 2, 200.00),
(3, 3, 3, 3, 300.00),
(4, 4, 4, 4, 400.00),
(5, 5, 5, 5, 500.00),
(6, 6, 6, 6, 600.00),
(7, 7, 7, 7, 700.00)
;

INSERT INTO payment (paymentid, bid, method, status) VALUES
(1, 1, 'Cash', 'Paid'),
(2, 2, 'Cheque', 'Pending'),
(3, 3, 'Visa', 'Due'),
(4, 4, 'Visa', 'Paid'),
(5, 5, 'Installments', 'Pending'),
(6, 6, 'Cash', 'Paid'),
(7, 7, 'Visa', 'Due')
;

INSERT INTO specialist (sid, specializeIn, fname, lname) VALUES
(1, 'Orthodontist', 'Ciaran', 'Quinn'),
(2, 'Periodontics', 'Aaron', 'Moran'),
(3, 'Prosthodontics', 'Blaine', 'Burke'),
(4, 'Endodontics', 'Thomas', 'Kenny'),
(5, 'Orthodontist', 'Joe', 'Biden'),
(6, 'Periodontics', 'Donald', 'Trump'),
(7, 'Endodontics', 'Barack', 'Obama')
;

INSERT INTO treatment (tid, sid, treatment, status) VALUES
(1, 1, 'Braces', 'Ongoing'),
(2, 2, 'Root canal', 'Ongoing'),
(3, 3, 'Whitening', 'Complete'),
(4, 4, 'Cleaning', 'Complete'),
(5, 5, 'Braces', 'Ongoing'),
(6, 6, 'Root canal', 'Complete'),
(7, 7, 'Whitening', 'Ongoing')
;

ALTER TABLE patient
ADD FOREIGN KEY (appid) REFERENCES appointment(appid);
ALTER TABLE patient
ADD FOREIGN KEY (billid) REFERENCES bill(bid);
ALTER TABLE appointment
ADD FOREIGN KEY (pid) REFERENCES patient(pid);
ALTER TABLE appointment
ADD FOREIGN KEY (sid) REFERENCES specialist(sid);
ALTER TABLE treatment
ADD FOREIGN KEY (sid) REFERENCES specialist(sid);
ALTER TABLE bill
ADD FOREIGN KEY (pid) REFERENCES patient(pid);
ALTER TABLE bill
ADD FOREIGN KEY (paymentid) REFERENCES payment(paymentid);
ALTER TABLE bill
ADD FOREIGN KEY (treatmentid) REFERENCES treatment(tid);
ALTER TABLE payment
ADD FOREIGN KEY (bid) REFERENCES bill(bid);

show warnings;
