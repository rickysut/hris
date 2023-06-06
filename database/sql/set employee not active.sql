Update employee
SET ACTIVE = 0
WHERE pin not IN (
    SELECT DISTINCT pin
    FROM attendance
    WHERE masuk BETWEEN '2023-04-26' AND '2023-05-31'
);