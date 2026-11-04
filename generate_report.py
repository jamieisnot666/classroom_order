import os
from docx import Document
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
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

    # 設定邊界為標準邊界 (上下左右各 2 公分 / 0.8 英吋，空間更充裕)
    for section in doc.sections:
        section.top_margin = Inches(0.8)
        section.bottom_margin = Inches(0.8)
        section.left_margin = Inches(0.8)
        section.right_margin = Inches(0.8)

    # ==================== 第 1 頁：封面 ====================
    p_cover_space = doc.add_paragraph()
    p_cover_space.paragraph_format.space_before = Pt(150)

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
    run_eng.font.size = Pt(18)
    run_eng.font.bold = True
    p_eng.paragraph_format.space_after = Pt(160)

    p_info = doc.add_paragraph()
    p_info.alignment = WD_ALIGN_PARAGRAPH.CENTER
    run_group = p_info.add_run("組別：第八組\n\n組員學號姓名：01357010 石智宇\n組員學號姓名：01357015 王傑民")
    run_group.font.name = "Microsoft JhengHei"
    run_group.font.size = Pt(13)
    run_group.font.bold = True

    doc.add_page_break()

    # ==================== 第 2 頁：一、功能介紹 & 二、DDL (全收納) ====================
    h1 = doc.add_heading("一、系統功能介紹", level=1)
    p_func = doc.add_paragraph(
        "本系統主要提供使用者查詢教室資訊及進行教室借用。使用者可以查詢目前系統中的教室資料，並新增自己的教室借用紀錄。\n"
        "系統也提供管理功能，可以查看目前所有借用紀錄，並修改借用狀態或刪除借用資料。\n"
        "為了簡化系統，本系統假設每一筆借用紀錄只對應一位使用者及一間教室。"
    )
    p_func.paragraph_format.line_spacing = 1.2
    p_func.paragraph_format.space_after = Pt(10)

    h2 = doc.add_heading("二、SQL DDL 和範例資料", level=1)

    # 1. user 表格
    p_u = doc.add_paragraph()
    r = p_u.add_run("1. user 表格")
    r.bold = True
    p_u.paragraph_format.space_after = Pt(2)
    p_ddl1 = doc.add_paragraph(
        "CREATE TABLE user (\n"
        "    user_id varchar(10) NOT NULL,\n"
        "    user_name varchar(50) NOT NULL,\n"
        "    PRIMARY KEY (user_id)\n"
        ");"
    )
    p_ddl1.paragraph_format.space_after = Pt(4)

    t_user = doc.add_table(rows=4, cols=2)
    t_user.alignment = WD_TABLE_ALIGNMENT.CENTER
    for i, h in enumerate(["user_id", "user_name"]):
        cell = t_user.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    user_data = [["U001", "王小明"], ["U002", "陳怡君"], ["U003", "林志豪"]]
    for r_idx, row in enumerate(user_data, start=1):
        for c_idx, val in enumerate(row):
            t_user.cell(r_idx, c_idx).text = val

    p_u_desc = doc.add_paragraph("[user_id] 記錄使用者的編號，為 Primary Key。  [user_name] 記錄使用者的姓名。")
    p_u_desc.paragraph_format.space_before = Pt(3)
    p_u_desc.paragraph_format.space_after = Pt(8)

    # 2. classroom 表格
    p_c = doc.add_paragraph()
    r = p_c.add_run("2. classroom 表格")
    r.bold = True
    p_c.paragraph_format.space_after = Pt(2)
    p_ddl2 = doc.add_paragraph(
        "CREATE TABLE classroom (\n"
        "    classroom_id varchar(10) NOT NULL,\n"
        "    classroom_name varchar(50) NOT NULL,\n"
        "    capacity int NOT NULL,\n"
        "    PRIMARY KEY (classroom_id)\n"
        ");"
    )
    p_ddl2.paragraph_format.space_after = Pt(4)

    t_class = doc.add_table(rows=4, cols=3)
    t_class.alignment = WD_TABLE_ALIGNMENT.CENTER
    for i, h in enumerate(["classroom_id", "classroom_name", "capacity"]):
        cell = t_class.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    class_data = [["C101", "E1-101", "50"], ["C102", "E1-102", "40"], ["C201", "E2-201", "80"]]
    for r_idx, row in enumerate(class_data, start=1):
        for c_idx, val in enumerate(row):
            t_class.cell(r_idx, c_idx).text = val

    p_c_desc = doc.add_paragraph("[classroom_id] 教室編號(PK)。  [classroom_name] 教室名稱。  [capacity] 可容納人數。")
    p_c_desc.paragraph_format.space_before = Pt(3)
    p_c_desc.paragraph_format.space_after = Pt(8)

    # 3. reservation 表格
    p_r = doc.add_paragraph()
    r = p_r.add_run("3. reservation 表格")
    r.bold = True
    p_r.paragraph_format.space_after = Pt(2)
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
    p_ddl3.paragraph_format.space_after = Pt(4)

    t_res = doc.add_table(rows=4, cols=5)
    t_res.alignment = WD_TABLE_ALIGNMENT.CENTER
    for i, h in enumerate(["reservation_id", "user_id", "classroom_id", "reservation_date", "status"]):
        cell = t_res.cell(0, i)
        cell.text = h
        set_cell_background(cell, "E0E7FF")
    res_data = [
        ["1", "U001", "C101", "2026-11-10", "approved"],
        ["2", "U002", "C102", "2026-11-11", "pending"],
        ["3", "U001", "C201", "2026-11-15", "approved"]
    ]
    for r_idx, row in enumerate(res_data, start=1):
        for c_idx, val in enumerate(row):
            t_res.cell(r_idx, c_idx).text = val

    p_r_desc = doc.add_paragraph("[reservation_id] 借用編號(PK)。 [user_id] 使用者編號(FK)。 [classroom_id] 教室編號(FK)。 [reservation_date] 日期。 [status] 狀態。")
    p_r_desc.paragraph_format.space_before = Pt(3)

    doc.add_page_break()

    # ==================== 第 3 頁：三、SQL DML ====================
    doc.add_heading("三、SQL DML", level=1)
    
    dmls = [
        ("顯示所有教室資訊", "SELECT *\nFROM classroom;", None),
        ("顯示借用紀錄、借用人姓名及教室名稱 (JOIN 查詢)",
         "SELECT U.user_name, C.classroom_name, R.reservation_date, R.status\n"
         "FROM reservation AS R\n"
         "JOIN user AS U ON R.user_id = U.user_id\n"
         "JOIN classroom AS C ON R.classroom_id = C.classroom_id;",
         "使用 JOIN 連接 reservation、user 與 classroom 三個表格，顯示借用紀錄對應的使用者及教室。"),
        ("統計每間教室的借用次數 (Aggregate Function 查詢)",
         "SELECT classroom_id, COUNT(*) AS reservation_count\n"
         "FROM reservation\n"
         "GROUP BY classroom_id;",
         "使用 aggregate function COUNT() 搭配 GROUP BY 統計每間教室借用次數。"),
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
        run.font.size = Pt(11)
        p_t.paragraph_format.space_before = Pt(4)
        p_t.paragraph_format.space_after = Pt(2)
        
        p_s = doc.add_paragraph(sql)
        p_s.paragraph_format.left_indent = Inches(0.2)
        p_s.paragraph_format.space_after = Pt(2)
        
        if note:
            p_n = doc.add_paragraph(note)
            p_n.paragraph_format.space_after = Pt(6)
        else:
            p_s.paragraph_format.space_after = Pt(6)

    doc.add_page_break()

    # ==================== 第 4 頁：四、網站結構 (含精美彩色樹狀圖) ====================
    doc.add_heading("四、網站結構", level=1)
    
    sitemap_path = r"C:\Users\USER\Desktop\程式用\資料庫系統\screenshots\sitemap.png"
    if os.path.exists(sitemap_path):
        doc.add_picture(sitemap_path, width=Inches(6.2))
        p_sm_c = doc.add_paragraph("圖：教室借用系統網站階層架構樹狀圖 (Site Map)")
        p_sm_c.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p_sm_c.paragraph_format.space_after = Pt(8)

    arch_desc = [
        "1. index.php 為教室借用系統首頁，可以進入教室查詢及借用相關功能。",
        "2. classroom.php 提供使用者查詢目前系統內的教室資料。",
        "3. reservation.php 提供使用者查看目前的借用紀錄。",
        "4. reservation_add.php 提供使用者新增教室借用資料。",
        "5. reservation_manage.php 提供管理功能，可以查看、修改及刪除目前的借用紀錄。"
    ]
    for item in arch_desc:
        p_item = doc.add_paragraph(item)
        p_item.paragraph_format.space_after = Pt(3)

    doc.add_page_break()

    # ==================== 第 5 頁：畫面設計 1 & 2 ====================
    doc.add_heading("五、畫面設計", level=1)
    
    img_dir = r"C:\Users\USER\Desktop\程式用\資料庫系統\screenshots"

    # 1. 首頁
    p_s1 = doc.add_paragraph()
    r = p_s1.add_run("1. 首頁 (index.php)")
    r.bold = True
    p_s1.paragraph_format.space_after = Pt(2)
    doc.add_picture(os.path.join(img_dir, "1_index.png"), width=Inches(5.8))
    p_d1 = doc.add_paragraph("首頁顯示系統名稱「教室借用系統」，並提供四大主要功能模組卡片。")
    p_d1.paragraph_format.space_after = Pt(12)

    # 2. 教室查詢
    p_s2 = doc.add_paragraph()
    r = p_s2.add_run("2. 教室查詢頁面 (classroom.php)")
    r.bold = True
    p_s2.paragraph_format.space_after = Pt(2)
    doc.add_picture(os.path.join(img_dir, "2_classroom.png"), width=Inches(5.8))
    p_d2 = doc.add_paragraph("顯示開放教室的編號、教室名稱與容納人數，並提供即時搜尋功能。")

    doc.add_page_break()

    # ==================== 第 6 頁：畫面設計 3 & 4 ====================
    p_h5_2 = doc.add_paragraph()
    r = p_h5_2.add_run("五、畫面設計（續）")
    r.bold = True
    r.font.size = Pt(14)
    p_h5_2.paragraph_format.space_after = Pt(4)

    # 3. 借用紀錄
    p_s3 = doc.add_paragraph()
    r = p_s3.add_run("3. 借用紀錄頁面 (reservation.php)")
    r.bold = True
    p_s3.paragraph_format.space_after = Pt(2)
    doc.add_picture(os.path.join(img_dir, "3_reservation.png"), width=Inches(5.8))
    p_d3 = doc.add_paragraph("展示所有借用紀錄與審核狀態（approved、pending），頂部呈現教室借用統計。")
    p_d3.paragraph_format.space_after = Pt(12)

    # 4. 新增借用
    p_s4 = doc.add_paragraph()
    r = p_s4.add_run("4. 新增借用頁面 (reservation_add.php)")
    r.bold = True
    p_s4.paragraph_format.space_after = Pt(2)
    doc.add_picture(os.path.join(img_dir, "4_reservation_add.png"), width=Inches(5.8))
    p_d4 = doc.add_paragraph("提供借用人編號、預約教室及借用日期填寫表單後送出登記。")

    doc.add_page_break()

    # ==================== 第 7 頁：畫面設計 5 & 六、工作分配 ====================
    p_h5_3 = doc.add_paragraph()
    r = p_h5_3.add_run("五、畫面設計（續）")
    r.bold = True
    r.font.size = Pt(14)
    p_h5_3.paragraph_format.space_after = Pt(4)

    # 5. 借用管理
    p_s5 = doc.add_paragraph()
    r = p_s5.add_run("5. 借用管理頁面 (reservation_manage.php)")
    r.bold = True
    p_s5.paragraph_format.space_after = Pt(2)
    doc.add_picture(os.path.join(img_dir, "5_reservation_manage.png"), width=Inches(5.8))
    p_d5 = doc.add_paragraph("管理員後台，提供一鍵修改審核狀態 (UPDATE) 或刪除無效紀錄 (DELETE)。")
    p_d5.paragraph_format.space_after = Pt(16)

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
    p_work.paragraph_format.line_spacing = 1.25

    # 存檔
    out_path = r"C:\Users\USER\Desktop\程式用\資料庫系統\教室借用系統_書面報告I.docx"
    doc.save(out_path)
    print(f"Compact Word 報告成功儲存至: {out_path}")

if __name__ == '__main__':
    create_report()
