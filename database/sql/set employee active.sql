Update employee
SET ACTIVE = 1
WHERE pin IN (
    SELECT DISTINCT pin
    FROM attendance
    WHERE masuk BETWEEN '2023-04-26' AND '2023-05-31'
);