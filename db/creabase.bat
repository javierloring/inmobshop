@echo off
cd C:\xampp\mysql\bin
copy C:\xampp\htdocs\inmobshop\db\inmobshop.sql C:\xampp\mysql\bin\inmobshop.sql
mysql -u root -p < inmobshop.sql
exit