UPDATE employee
INNER JOIN subdepartment ON employee.st_sub = subdepartment.name
SET employee.subdept_id = subdepartment.id;
