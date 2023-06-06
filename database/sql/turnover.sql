SELECT YEAR(end_date) AS year,
       MONTH(end_date) AS month,
       COUNT(DISTINCT employee.id) AS turnover_count,
       department.name
FROM employee
INNER JOIN department ON department.id = employee.dept_id
and end_date IS NOT NULL AND ACTIVE = 0
GROUP BY YEAR(end_date), MONTH(end_date), dept_id
ORDER BY YEAR(end_date), MONTH(end_date), dept_id;