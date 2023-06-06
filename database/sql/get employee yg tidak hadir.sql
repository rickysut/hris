SELECT COUNT(*) AS absent
FROM Employee
WHERE id NOT IN (
    SELECT karyawan_id
    FROM Attendance
    WHERE tanggal BETWEEN '2023-04-26' AND '2023-05-25'
);