INSERT INTO leave_code (CODE, DESCRIPTION, cut_leave)
SELECT 
biov6.alasan.kdAlasan,
biov6.alasan.Keterangan,
0
FROM biov6.alasan
