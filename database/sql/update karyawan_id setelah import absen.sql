UPDATE attendance SET karyawan_id = (SELECT employee.id FROM employee WHERE employee.pin = attendance.pin)