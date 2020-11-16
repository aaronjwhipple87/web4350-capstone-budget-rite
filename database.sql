USE W01210609;

-- CREATE TABLES
CREATE TABLE IF NOT EXISTS users (
    userID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    firstName VARCHAR(75) NOT NULL,
    lastName VARCHAR(75) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(11),
    userPassword VARCHAR(100) NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    created_at TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS transactions (
    transactionID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    transactionName VARCHAR(100),
    transactionAmount DECIMAL(13,2),
    transactionDate DATE,
    budgetID INT NOT NULL,
    userID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS budgets (
    budgetID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    budgetName VARCHAR(100),
    plannedAmount DECIMAL(13,2),
    appliedAmount DECIMAL(13,2),
    dueDate DATE,
    notes VARCHAR(1000),
    categoryID INT NOT NULL,
    userID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    categoryName VARCHAR(100),
    userID INT NOT NULL
);

-- ADD FK CONSTRAINTS

ALTER TABLE transactions
ADD FOREIGN KEY (userID) REFERENCES users(userID);

ALTER TABLE transactions
ADD FOREIGN KEY (budgetID) REFERENCES budgets(budgetID);

ALTER TABLE budgets
ADD FOREIGN KEY (categoryID) REFERENCES categories(categoryID);

ALTER TABLE budgets
ADD FOREIGN KEY (userID) REFERENCES users(userID);

ALTER TABLE categories
ADD FOREIGN KEY (userID) REFERENCES users(userID);


USE W01210609;
drop table if exists categories, labels, transactions, banks, users, usersTransactions
