UPDATE employee AS e
JOIN (
    SELECT pin, MIN(tanggal) AS min_date
    FROM attendance
    GROUP BY pin
) AS a ON e.pin = a.pin AND e.active = 0
SET e.start_date = a.min_date;
