INSERT INTO hris.subdepartment (NAME, departemen, department_id)
SELECT 
biov6.sub.NAMASUB,
biov6.sub.NAMADEPT,
1
FROM biov6.sub