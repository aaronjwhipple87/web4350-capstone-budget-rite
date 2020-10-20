USE W01210609;

-- CREATE TABLES
CREATE TABLE IF NOT EXISTS users (
    userID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    firstName VARCHAR(75) NOT NULL,
    lastName VARCHAR(75) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(11),
    userPassword VARCHAR(100) NOT NULL,
    update_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    bankId INT NOT NULL
);

CREATE TABLE IF NOT EXISTS banks (
    bankID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    bankName VARCHAR(100) NOT NULL,
    routingNumber INT NOT NULL,
    accountNumber INT NOT NULL
);

CREATE TABLE IF NOT EXISTS transactions (
    transactionID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    transactionType VARCHAR(100),
    labelID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS usersTransactions (
    transactionID INT NOT NULL,
    userID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS labels (
    labelID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    labelName VARCHAR(100),
    plannedAmount INT,
    receivedAmount INT,
    dueDate DATE,
    notes VARCHAR(1000),
    categoryID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    categoryName VARCHAR(100)
);

-- ADD FK CONSTRAINTS
ALTER TABLE users
ADD FOREIGN KEY (bankID) REFERENCES banks(bankID);

ALTER TABLE usersTransactions
ADD FOREIGN KEY (transactionID) REFERENCES transactions(transactionID);

ALTER TABLE usersTransactions
ADD FOREIGN KEY (userID) REFERENCES users(userID);

ALTER TABLE transactions
ADD FOREIGN KEY (labelID) REFERENCES labels(labelID);

ALTER TABLE labels
ADD FOREIGN KEY (categoryID) REFERENCES categories(categoryID);

USE W01210609;
drop table if exists categories, labels, transactions, banks, users, usersTransactions
