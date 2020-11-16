-- top 10 transactions query
SELECT t.transactionName, c.categoryName, b.budgetName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate
FROM
	transactions as t 
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
lEFT JOIN
	categories as c on b.categoryID = c.categoryID
WHERE
	t.userID = 1
ORDER BY
	transactionDate DESC
LIMIT 10

-- get spent amount
SELECT sum(t.transactionAmount)
FROM
    transactions as t
LEFT JOIN
    budgets as b on t.budgetID = b.budgetID
LEFT JOIN
    categories as c on b.categoryID = c.categoryID
WHERE 
    t.userID = 1
    AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
    AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
    AND c.categoryName != 'income'
    AND c.categoryName != 'savings'

-- get income amount
SELECT sum(t.transactionAmount)
FROM
    transactions as t
LEFT JOIN
    budgets as b on t.budgetID = b.budgetID
LEFT JOIN
    categories as c on b.categoryID = c.categoryID
WHERE 
    t.userID = 1
    AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
    AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
    AND c.categoryName != 'bills'
    AND c.categoryName != 'expenses'

-- get cateogry totals
SELECT c.categoryName, SUM(t.transactionAmount) as categorySum
FROM	
	transactions as t
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
LEFT JOIN
	categories as c on b.categoryID = c.categoryID
WHERE
	t.userID = 1
GROUP BY
	c.categoryName

-- get budget totals
SELECT b.budgetName, SUM(t.transactionAmount) as budgetSum
FROM
	transactions as t 
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
WHERE 
	t.userID = 1
GROUP BY
	b.budgetName

-- seed data
--categories
INSERT INTO categories (categoryName, userID)
VALUES ('bills', 1),
        ('income', 1),
        ('expenses', 1),
        ('savings', 1)
--budgets
INSERT INTO budgets (budgetName, plannedAmount, appliedAmount, dueDate, notes, categoryID, userID)
VALUES
    ('Mortgage', 1000, 1000, '2020-11-01', 'These are some notes', 1, 1),
    ('Subscriptions', 100, 10, NULL, 'These are some more notes', 3, 1),
    ('Pay Check', 2000, 2000, NULL, 'These are some notes', 2, 1)

-- transactions
INSERT INTO transactions (transactionName, transactionAmount, budgetID, userID)
VALUES ('spotify', 5.99, 2, 1),
    ('disney plus', 7.99, 2, 1),
    ('hulu', 12.99, 2, 1),
    ('netflix', 10, 2, 1),
    ('academy mortage', 1000, 1, 1),
    ('Pay Check', 1000, 3, 1),
    ('iPhone', 50.99, 2, 1),
    ('spotify', 5.99, 2, 1),
    ('disney plus', 7.99, 2, 1),
    ('hulu', 12.99, 2, 1),
    ('netflix', 10, 2, 1),
    ('spotify', 5.99, 2, 1)
