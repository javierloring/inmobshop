@echo off
cd C:\xampp\mysql\bin
copy C:\xampp\htdocs\inmobshop\db\data_inmobshop.sql C:\xampp\mysql\bin\data_inmobshop.sql
mysql -u root -p < data_inmobshop.sql
exit