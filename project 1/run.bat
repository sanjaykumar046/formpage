@echo off
cd /d C:\xampp\htdocs\project 1
start python app.py
timeout /t 3
start http://127.0.0.1:5000
