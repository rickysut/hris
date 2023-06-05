SELECT COUNT(pin) FROM 
attendance 
WHERE masuk > jadwalmasuk AND
masuk IS NOT NULL AND
tanggal between '2023-04-26' AND '2023-05-30';

SELECT COUNT(pin) FROM 
attendance 
WHERE masuk <  jadwalmasuk AND
masuk IS NOT NULL and
tanggal between '2023-04-26' AND '2023-05-30';

SELECT COUNT(pin) FROM 
attendance 
WHERE jadwalmasuk IS not null AND
masuk is NULL and
tanggal between '2023-04-26' AND '2023-05-30';