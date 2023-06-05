UPDATE employee AS e
JOIN (
    SELECT pin, MAX(tanggal) AS max_date
    FROM attendance
    GROUP BY pin
) AS a ON e.pin = a.pin AND e.active = 0
SET e.end_date = a.max_date;
