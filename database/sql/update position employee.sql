UPDATE employee
INNER JOIN positions ON employee.st_jabatan = positions.name
SET employee.position_id = positions.id;
