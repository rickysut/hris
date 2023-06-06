UPDATE employee
INNER JOIN department ON employee.st_departemen = department.name
SET employee.dept_id = department.id;
