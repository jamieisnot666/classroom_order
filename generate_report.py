import os
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT, WD_ALIGN_VERTICAL
from docx.oxml import OxmlElement
from docx.oxml.ns import qn

def set_cell_background(cell, fill_hex):
    tcPr = cell._tc.get_or_add_tcPr()
    shd = OxmlElement('w:shd')
    shd.set(qn('w:val'), 'clear')
    shd.set(qn('w:color'), 'auto')
    shd.set(qn('w:fill'), fill_hex)
    tcPr.append(shd)

def create_report():
    doc = Document()

    # 設定邊界
    for section in doc.sections:
        section.top_margin = Inches(1)
        section.bottom_margin = Inches(1)
        section.left_margin = Inches(1)
        section.right_margin = Inches(1)

    # 封面
    p_cover_space = doc.add_paragraph()
    p_cover_space.paragraph_format.space_before = Pt(140)

    p_title = doc.add_paragraph()
    p_title.alignment = WD_ALIGN_PARAGRAPH.CENTER
    run_title = p_title.add_run("教室借用系統")
    run_title.font.name = "Microsoft JhengHei"
    run_title.font.size = Pt(28)
    run_title.font.bold = True

    p_eng = doc.add_paragraph()
    p_eng.alignment = WD_ALIGN_PARAGRAPH.CENTER
    run_eng = p_eng.add_run("Classroom Reservation System")
    run_eng.font.name = "Arial"
    run_eng.font.size = Pt(20)
    run_eng.font.bold = True
    p_eng.paragraph_format.space_after = Pt(150)

    p_info = doc.add_paragraph()
    p_info.alignment = WD_ALIGN_PARAGRAPH.CENTER
    run_group = p_info.add_run("組別：第八組\n\n組員學號姓名：01357010 石智宇\n組員學號姓名：01357015 王傑民")
    run_group.font.name = "Microsoft JhengHei"
    run_group.font.size = Pt(14)
    run_group.font.bold = True

    doc.add_page_break()

    # 一、系統功能介紹
    h1 = doc.add_heading("一、系統功能介紹", level=1)
    h1.style.font.name = "Microsoft JhengHei"
    p_func = doc.add_paragraph(
        "本系統主要提供使用者查詢教室資訊及進行教室借用。使用者可以查詢目前系統中的教室資料，並新增自己的教室借用紀錄。\n\n"
        "系統也提供管理功能，可以查看目前所有借用紀錄，並修改借用狀態或刪除借用資料。\n\n"
        "為了簡化系統，本系統假設每一筆借用紀錄只對應一位使用者及一間教室。"
    )
    p_func.paragraph_format.line_spacing = 1.3
    p_func.paragraph_format.space_after = Pt(16)

    # 二、SQL DDL 和範例資料
    h2 = doc.add_heading("二、SQL DDL 和範例資料", level=1)
    
    # user 表格
    p_u_title = doc.add_paragraph()
    run_u = p_u_title.add_run("user 表格")
    run_u.font.bold = True
    run_u.font.size = Pt(13)

    p_ddl1 = doc.add_paragraph(
        "CREATE TABLE user (\n"
        "    user_id varchar(10) NOT NULL,\n"
        "    user_name varchar(50) NOT NULL,\n"
        "    PRIMARY KEY (user_id)\n"
        ");"
    )
    p_ddl1.paragraph_format.space_after = Pt(8)

    t_user = doc.add_table(rows=4, cols=2)
    t_user.alignment = WD_TABLE_ALIGNMENT.CENTER
    headers = ["user_id", "user_name"]
    for i, h in enumerate(headers):
        cell = t_user.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    user_data = [
        ["U001", "王小明"],
        ["U002", "陳怡君"],
        ["U003", "林志豪"]
    ]
    for row_idx, row in enumerate(user_data, start=1):
        for col_idx, val in enumerate(row):
            t_user.cell(row_idx, col_idx).text = val

    p_u_desc = doc.add_paragraph(
        "\n[user_id] 記錄使用者的編號，為 Primary Key。\n"
        "[user_name] 記錄使用者的姓名。"
    )
    p_u_desc.paragraph_format.space_after = Pt(16)

    # classroom 表格
    p_c_title = doc.add_paragraph()
    run_c = p_c_title.add_run("classroom 表格")
    run_c.font.bold = True
    run_c.font.size = Pt(13)

    p_ddl2 = doc.add_paragraph(
        "CREATE TABLE classroom (\n"
        "    classroom_id varchar(10) NOT NULL,\n"
        "    classroom_name varchar(50) NOT NULL,\n"
        "    capacity int NOT NULL,\n"
        "    PRIMARY KEY (classroom_id)\n"
        ");"
    )
    p_ddl2.paragraph_format.space_after = Pt(8)

    t_class = doc.add_table(rows=4, cols=3)
    t_class.alignment = WD_TABLE_ALIGNMENT.CENTER
    c_headers = ["classroom_id", "classroom_name", "capacity"]
    for i, h in enumerate(c_headers):
        cell = t_class.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    class_data = [
        ["C101", "E1-101", "50"],
        ["C102", "E1-102", "40"],
        ["C201", "E2-201", "80"]
    ]
    for row_idx, row in enumerate(class_data, start=1):
        for col_idx, val in enumerate(row):
            t_class.cell(row_idx, col_idx).text = val

    p_c_desc = doc.add_paragraph(
        "\n[classroom_id] 記錄教室編號，為 Primary Key。\n"
        "[classroom_name] 記錄教室名稱。\n"
        "[capacity] 記錄教室可容納的人數。"
    )
    p_c_desc.paragraph_format.space_after = Pt(16)

    # reservation 表格
    p_r_title = doc.add_paragraph()
    run_r = p_r_title.add_run("reservation 表格")
    run_r.font.bold = True
    run_r.font.size = Pt(13)

    p_ddl3 = doc.add_paragraph(
        "CREATE TABLE reservation (\n"
        "    reservation_id int NOT NULL,\n"
        "    user_id varchar(10) NOT NULL,\n"
        "    classroom_id varchar(10) NOT NULL,\n"
        "    reservation_date date NOT NULL,\n"
        "    status varchar(20) NOT NULL,\n"
        "    PRIMARY KEY (reservation_id),\n"
        "    FOREIGN KEY (user_id) REFERENCES user(user_id),\n"
        "    FOREIGN KEY (classroom_id) REFERENCES classroom(classroom_id)\n"
        ");"
    )
    p_ddl3.paragraph_format.space_after = Pt(8)

    t_res = doc.add_table(rows=4, cols=5)
    t_res.alignment = WD_TABLE_ALIGNMENT.CENTER
    r_headers = ["reservation_id", "user_id", "classroom_id", "reservation_date", "status"]
    for i, h in enumerate(r_headers):
        cell = t_res.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    res_data = [
        ["1", "U001", "C101", "2026-11-10", "approved"],
        ["2", "U002", "C102", "2026-11-11", "pending"],
        ["3", "U001", "C201", "2026-11-15", "approved"]
    ]
    for row_idx, row in enumerate(res_data, start=1):
        for col_idx, val in enumerate(row):
            t_res.cell(row_idx, col_idx).text = val

    p_r_desc = doc.add_paragraph(
        "\n[reservation_id] 記錄每一筆借用資料的編號，為 Primary Key。\n"
        "[user_id] 記錄借用人的使用者編號，為 Foreign Key。\n"
        "[classroom_id] 記錄被借用的教室編號，為 Foreign Key。\n"
        "[reservation_date] 記錄教室借用日期。\n"
        "[status] 記錄目前的借用狀態，例如 pending、approved。"
    )

    doc.add_page_break()

    # 三、SQL DML
    doc.add_heading("三、SQL DML", level=1)
    
    dmls = [
        ("顯示所有教室資訊", "SELECT *\nFROM classroom;", None),
        ("顯示借用紀錄、借用人姓名及教室名稱",
         "SELECT U.user_name, C.classroom_name, R.reservation_date, R.status\n"
         "FROM reservation AS R\n"
         "JOIN user AS U ON R.user_id = U.user_id\n"
         "JOIN classroom AS C ON R.classroom_id = C.classroom_id;",
         "此查詢使用 JOIN 將 reservation、user 與 classroom 三個表格連接，可以顯示每一筆借用紀錄所對應的使用者及教室資料。"),
        ("統計每間教室的借用次數",
         "SELECT classroom_id, COUNT(*) AS reservation_count\n"
         "FROM reservation\n"
         "GROUP BY classroom_id;",
         "此查詢使用 aggregate function COUNT() 統計每間教室目前共有多少筆借用紀錄。"),
        ("新增教室借用紀錄",
         "INSERT INTO reservation (reservation_id, user_id, classroom_id, reservation_date, status)\n"
         "VALUES (4, 'U003', 'C101', '2026-11-20', 'pending');", None),
        ("修改借用狀態",
         "UPDATE reservation\n"
         "SET status = 'approved'\n"
         "WHERE reservation_id = 2;", None),
        ("刪除借用紀錄",
         "DELETE FROM reservation\n"
         "WHERE reservation_id = 3;", None)
    ]

    for title, sql, note in dmls:
        p_t = doc.add_paragraph()
        run = p_t.add_run(title)
        run.bold = True
        run.font.size = Pt(11.5)
        
        p_s = doc.add_paragraph(sql)
        p_s.paragraph_format.left_indent = Inches(0.2)
        p_s.paragraph_format.space_after = Pt(4)
        
        if note:
            p_n = doc.add_paragraph(note)
            p_n.paragraph_format.space_after = Pt(10)
        else:
            p_s.paragraph_format.space_after = Pt(10)

    doc.add_page_break()

    # 四、網站結構
    doc.add_heading("四、網站結構", level=1)
    p_arch = doc.add_paragraph(
        "index.php\n"
        "│\n"
        "├── classroom.php\n"
        "│\n"
        "├── reservation.php\n"
        "│    └── reservation_add.php\n"
        "│\n"
        "└── reservation_manage.php\n"
    )
    p_arch.paragraph_format.left_indent = Inches(0.2)
    p_arch.paragraph_format.space_after = Pt(12)

    arch_desc = [
        "1. index.php 為教室借用系統首頁，可以進入教室查詢及借用相關功能。",
        "2. classroom.php 提供使用者查詢目前系統內的教室資料。",
        "3. reservation.php 提供使用者查看目前的借用紀錄。",
        "4. reservation_add.php 提供使用者新增教室借用資料。",
        "5. reservation_manage.php 提供管理功能，可以查看、修改及刪除目前的借用紀錄。"
    ]
    for item in arch_desc:
        p_item = doc.add_paragraph(item)
        p_item.paragraph_format.space_after = Pt(4)

    doc.add_page_break()

    # 五、畫面設計 (含5張圖片)
    doc.add_heading("五、畫面設計", level=1)
    
    img_dir = r"C:\Users\USER\Desktop\程式用\資料庫系統\screenshots"
    screens = [
        ("1. 首頁 (index.php)", os.path.join(img_dir, "1_index.png"), "首頁提供系統簡介與四大核心功能入口（查詢教室、查看借用紀錄、新增借用、借用管理）。"),
        ("2. 教室查詢頁面 (classroom.php)", os.path.join(img_dir, "2_classroom.png"), "顯示系統內所有教室的編號、教室名稱與容納人數，並提供關鍵字即時搜尋功能。"),
        ("3. 借用紀錄頁面 (reservation.php)", os.path.join(img_dir, "3_reservation.png"), "顯示目前登記之借用排程、借用人姓名、教室與狀態，並包含各教室借用次數統計卡片。"),
        ("4. 新增借用頁面 (reservation_add.php)", os.path.join(img_dir, "4_reservation_add.png"), "提供使用者選擇借用人 (user_id)、預約教室 (classroom_id) 與借用日期 (reservation_date) 之表單。"),
        ("5. 借用管理頁面 (reservation_manage.php)", os.path.join(img_dir, "5_reservation_manage.png"), "管理員專用後台，可直接點擊按鈕更新借用審核狀態 (UPDATE) 或刪除無效紀錄 (DELETE)。")
    ]

    for title, img_path, desc in screens:
        p_st = doc.add_paragraph()
        run = p_st.add_run(title)
        run.bold = True
        run.font.size = Pt(12)
        p_st.paragraph_format.space_before = Pt(8)
        p_st.paragraph_format.space_after = Pt(4)

        if os.path.exists(img_path):
            doc.add_picture(img_path, width=Inches(6.2))
        
        p_sd = doc.add_paragraph(desc)
        p_sd.paragraph_format.space_after = Pt(14)

    doc.add_page_break()

    # 六、工作分配
    doc.add_heading("六、工作分配", level=1)
    p_work = doc.add_paragraph(
        "組員 A：\n"
        "● 建立資料庫\n"
        "● 設計 user、classroom、reservation 三個表格\n"
        "● 撰寫 classroom.php\n"
        "● 撰寫 reservation_add.php\n\n"
        "組員 B：\n"
        "● 撰寫 reservation.php\n"
        "● 撰寫 reservation_manage.php\n"
        "● 負責修改與刪除功能\n"
        "● 負責網頁畫面設計\n\n"
        "兩人共同負責系統測試、網站整合及書面報告整理。"
    )
    p_work.paragraph_format.line_spacing = 1.3

    # 存檔
    out_path = r"C:\Users\USER\Desktop\程式用\資料庫系統\教室借用系統_書面報告I.docx"
    doc.save(out_path)
    print(f"Word 報告成功儲存至: {out_path}")

if __name__ == '__main__':
    create_report()
