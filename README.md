# 教室借用系統 (Classroom Reservation System)
> 資料庫系統專案 - 第八組（01357010 石智宇、01357015 王傑民）

---

## 📁 系統檔案結構
```text
C:\Users\USER\Desktop\程式用\資料庫系統\
│
├── index.php                 # 首頁（系統介紹、功能入口卡片）
├── classroom.php             # 教室查詢頁面（顯示所有教室、搜尋過濾）
├── reservation.php           # 借用紀錄頁面（顯示借用資料、次數統計）
├── reservation_add.php       # 新增借用頁面（輸入借用人、教室、日期表單）
├── reservation_manage.php    # 借用管理頁面（審核通過、刪除紀錄）
│
├── preview_server.py         # 本地預覽 Python 伺服器
├── 點我一鍵開啟網頁預覽(截圖用).bat # 雙擊直接在瀏覽器預覽並截圖
└── README.md                 # 專案說明與雙人共編指南
```

---

## 📸 如何開啟預覽並截圖給報告用？
1. 直接在資料夾內**連按兩下** `點我一鍵開啟網頁預覽(截圖用).bat`。
2. 系統會自動啟動本地預覽並開啟瀏覽器（網址：`http://localhost:8080/index.php`）。
3. 依序切換上方導覽列的各頁面：
   - **首頁 (`index.php`)**
   - **查詢教室 (`classroom.php`)**
   - **借用紀錄 (`reservation.php`)**
   - **新增借用 (`reservation_add.php`)**
   - **借用管理 (`reservation_manage.php`)**
4. 按鍵盤 `Win + Shift + S` 或截圖工具截取各頁面，貼入書面報告的**「五、畫面設計」**即可！

---

## 👥 雙人共編指南 (推薦使用 GitHub)

為了讓兩位組員可以同時在各自電腦上開發與同步程式碼，推薦使用 **GitHub** 進行版本控制：

### 步驟 1：在 GitHub 建立儲存庫 (Repository)
1. 其中一位同學登入 [GitHub](https://github.com/)。
2. 點擊右上角 **New repository**。
3. Repository name 填寫例如 `classroom-reservation-system`。
4. 選擇 **Private**（私有儲存庫，避免作業被其他人抄襲）。
5. 點擊 **Create repository**。
6. 在 Settings -> Collaborators 中加入另一位組員的 GitHub 帳號。

### 步驟 2：本機推送程式碼至 GitHub
開啟 PowerShell 或 VS Code 終端機，執行以下指令：
```bash
cd "C:\Users\USER\Desktop\程式用\資料庫系統"
git remote add origin https://github.com/<你的GitHub帳號>/<你的儲存庫名稱>.git
git branch -M main
git push -u origin main
```

### 步驟 3：另一位組員下載專案
另一位組員在自己電腦的終端機輸入：
```bash
git clone https://github.com/<GitHub帳號>/<儲存庫名稱>.git
```

### 步驟 4：日常共編流程
- **每次開始寫程式前**先拉取最新版本：
  ```bash
  git pull
  ```
- **寫完或修改後**提交並推送：
  ```bash
  git add .
  git commit -m "更新說明"
  git push
  ```

---

## 🗄️ 未來串接資料庫指引（第二階段）
當課程教到 PHP 連接 MariaDB/MySQL 時：
1. 下載並安裝 **XAMPP**。
2. 開啟 XAMPP Control Panel，啟動 **Apache** 與 **MySQL**。
3. 將本資料夾整包放入 `C:\xampp\htdocs\classroom\`。
4. 建立 `db_connect.php` 使用 `mysqli_connect` 或 `PDO` 連接資料庫。
5. 將各頁面頂部的靜態模擬資料換成執行 SQL 查詢（即報告第三部分寫好的 DML 語法）！
