@echo off
Copy "datos-inmobshop.sql" "C:\xampp\mysql\bin\datos-inmobshop.sql"
cd C:\xampp\mysql\bin
mysql -u root -p < datos-inmobshop.sql
exit
