-- top 10 transactions queries
SELECT t.transactionName, b.budgetName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate
FROM
    users as u
LEFT JOIN
    usersTransactions as us
    ON u.userID = us.userID
LEFT JOIN
    transactions as t
    ON us.transactionID = t.transactionID
LEFT JOIN
    budgets as b
    ON t.budgetID = b.budgetID
WHERE
    u.userID = 16
ORDER BY
    transactionDate LIMIT 10


-- seed data
--categories
INSERT INTO categories (categoryName)
VALUES ('bills'),
        ('income'),
        ('expenses'),
        ('savings')
--budgets
INSERT INTO budgets (budgetName, plannedAmount, appliedAmount, dueDate, notes, categoryID)
VALUES
    ('Mortgage', 1000, 1000, '2020-11-01', 'These are some notes', 1),
    ('Subscriptions', 100, 10, NULL, 'These are some more notes', 3),
    ('Pay Check', 2000, 2000, NULL, 'These are some notes', 2)
-- transactions
INSERT INTO transactions (transactionName, transactionAmount, budgetID)
VALUES ('spotify', 5.99, 2),
    ('disney plus', 7.99, 2),
    ('hulu', 12.99, 2),
    ('netflix', 10, 2),
    ('academy mortage', 1000, 1),
    ('Pay Check', 1000, 3),
    ('iPhone', 50.99, 2),
    ('spotify', 5.99, 2),
    ('disney plus', 7.99, 2),
    ('hulu', 12.99, 2),
    ('netflix', 10, 2),
    ('spotify', 5.99, 2)

-- usersTransactions
INSERT INTO usersTransactions(transactionID, userID)
VALUES 
    (1, 16),
    (2, 16),
    (3, 16),
    (4, 16),
    (5, 16),
    (6, 16),
    (7, 16),
    (8, 16),
    (9, 16),
    (10, 16),
    (11, 16),
    (12, 16)
