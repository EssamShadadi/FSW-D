CREATE DATABASE test;


USE test;

-- Create Centers table
CREATE TABLE Centers (
    CenterID INT PRIMARY KEY AUTO_INCREMENT,
    CenterName VARCHAR(50) NOT NULL UNIQUE
);

-- Create Employees table
CREATE TABLE Employees (
    EmployeeID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    LocationID INT,
    FOREIGN KEY (LocationID) REFERENCES Centers(CenterID)
);

-- Create IT_Specialists table
CREATE TABLE IT_Specialists (
    SpecialistID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    LocationID INT,
    FOREIGN KEY (LocationID) REFERENCES Centers(CenterID)
);

-- Create Tickets table
CREATE TABLE Tickets (
    TicketID INT PRIMARY KEY AUTO_INCREMENT,
    EmployeeID INT,
    SpecialistID INT,
    Status ENUM('pending', 'in process', 'completed') DEFAULT 'pending',
    DateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ProblemDescription TEXT,
    ProblemType ENUM('hardware', 'software'),
    DeviceType ENUM('Laptop', 'Mobile', 'Printer', 'Access Point'),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID),
    FOREIGN KEY (SpecialistID) REFERENCES IT_Specialists(SpecialistID)
);

-- Create Hardware_Tickets table (inherits from Tickets)
CREATE TABLE Hardware_Tickets (
    TicketID INT PRIMARY KEY,
    SerialNumber VARCHAR(50),
    Picture BLOB,
    FOREIGN KEY (TicketID) REFERENCES Tickets(TicketID)
);

-- Create Software_Tickets table (inherits from Tickets)
CREATE TABLE Software_Tickets (
    TicketID INT PRIMARY KEY,
    OSVersion VARCHAR(50),
    AffectedSoftware ENUM('Office', 'Adobe Acrobat', 'Chrome', 'X-Gate', 'P&L', 'QuickBooks', 'BOB'),
    ErrorCode VARCHAR(50),
    Screenshot BLOB,
    FOREIGN KEY (TicketID) REFERENCES Tickets(TicketID)
);
