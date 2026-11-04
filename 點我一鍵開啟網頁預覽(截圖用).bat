@echo off
chcp 65001 >nul
echo 正在啟動教室借用系統預覽伺服器...
python "%~dp0preview_server.py"
pause
