<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教室借用系統 - 新增借用</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', "Microsoft JhengHei", sans-serif; }
    </style>
</head>
<body>

    <!-- 導航列 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-building-check me-2"></i>教室借用系統
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i>首頁</a></li>
                    <li class="nav-item"><a class="nav-link" href="classroom.php"><i class="bi bi-search me-1"></i>查詢教室</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php"><i class="bi bi-calendar-check me-1"></i>借用紀錄</a></li>
                    <li class="nav-item"><a class="nav-link active" href="reservation_add.php"><i class="bi bi-plus-circle me-1"></i>新增借用</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation_manage.php"><i class="bi bi-gear me-1"></i>借用管理</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 主體內容 -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- 標題區 -->
                <div class="mb-4 text-center">
                    <h3 class="fw-bold mb-2"><i class="bi bi-plus-circle me-2 text-primary"></i>新增教室借用申請</h3>
                    <p class="text-muted">填寫借用人資料、教室編號與預約日期後送出申請</p>
                </div>

                <!-- 模擬成功提示框 -->
                <div id="successAlert" class="alert alert-success alert-dismissible fade d-none" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>申請成功！</strong> 借用紀錄已新增（狀態：<code>pending 審核中</code>），請等待管理員核准。
                    <button type="button" class="btn-close" onclick="document.getElementById('successAlert').classList.add('d-none');"></button>
                </div>

                <!-- 表單卡片 -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <span class="fw-bold text-secondary"><i class="bi bi-pencil-square me-2"></i>借用資訊填寫</span>
                    </div>
                    <div class="card-body p-4">
                        <form id="reservationForm" onsubmit="handleSubmit(event)">
                            <!-- 借用人編號 (user_id) -->
                            <div class="mb-3">
                                <label for="user_id" class="form-label fw-bold">
                                    <i class="bi bi-person me-1 text-primary"></i>使用者編號 (user_id) <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="user_id" required>
                                    <option value="" selected disabled>請選擇使用者編號與姓名...</option>
                                    <option value="U001">U001 - 王小明</option>
                                    <option value="U002">U002 - 陳怡君</option>
                                    <option value="U003" selected>U003 - 林志豪</option>
                                </select>
                                <div class="form-text">對應資料庫中的 user 表格外鍵</div>
                            </div>

                            <!-- 教室編號 (classroom_id) -->
                            <div class="mb-3">
                                <label for="classroom_id" class="form-label fw-bold">
                                    <i class="bi bi-door-open me-1 text-primary"></i>教室編號 (classroom_id) <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="classroom_id" required>
                                    <option value="" disabled>請選擇預約教室...</option>
                                    <option value="C101" selected>C101 (E1-101) - 容納 50 人</option>
                                    <option value="C102">C102 (E1-102) - 容納 40 人</option>
                                    <option value="C201">C201 (E2-201) - 容納 80 人</option>
                                </select>
                                <div class="form-text">對應資料庫中的 classroom 表格外鍵</div>
                            </div>

                            <!-- 借用日期 (reservation_date) -->
                            <div class="mb-4">
                                <label for="reservation_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar3 me-1 text-primary"></i>借用日期 (reservation_date) <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="reservation_date" value="2026-11-20" required>
                                <div class="form-text">選擇預定借用教室之日期</div>
                            </div>

                            <!-- 提示資訊 -->
                            <div class="p-3 bg-light rounded mb-4 border">
                                <small class="text-muted d-block">
                                    <i class="bi bi-info-circle me-1 text-primary"></i>
                                    <strong>SQL INSERT 預覽：</strong>
                                    <code>INSERT INTO reservation (reservation_id, user_id, classroom_id, reservation_date, status) VALUES (4, 'U003', 'C101', '2026-11-20', 'pending');</code>
                                </small>
                            </div>

                            <!-- 按鈕區 -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="reservation.php" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>返回紀錄
                                </a>
                                <button type="reset" class="btn btn-outline-danger">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>清除重填
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-lg me-1"></i>新增借用
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <footer class="bg-white border-top py-4 mt-5 text-center text-muted">
        <div class="container">
            <small>教室借用系統 | 第八組（石智宇、王傑民）</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleSubmit(e) {
            e.preventDefault();
            const alertBox = document.getElementById('successAlert');
            alertBox.classList.remove('d-none');
            alertBox.classList.add('show');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>
