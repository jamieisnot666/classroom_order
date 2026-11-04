<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教室借用系統 - 查詢教室</title>
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
                    <li class="nav-item"><a class="nav-link active" href="classroom.php"><i class="bi bi-search me-1"></i>查詢教室</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php"><i class="bi bi-calendar-check me-1"></i>借用紀錄</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation_add.php"><i class="bi bi-plus-circle me-1"></i>新增借用</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation_manage.php"><i class="bi bi-gear me-1"></i>借用管理</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 主體內容 -->
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1"><i class="bi bi-door-open me-2 text-primary"></i>教室資訊查詢</h3>
                <p class="text-muted mb-0">瀏覽目前系統內開放借用的所有教室資料與容納人數</p>
            </div>
            <a href="reservation_add.php" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>直接登記借用
            </a>
        </div>

        <!-- 搜尋列與篩選卡片 -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="輸入教室編號或名稱搜尋（例如：E1-101、C101）...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="capacityFilter">
                            <option value="all">所有容納人數</option>
                            <option value="50">50 人以下</option>
                            <option value="51">50 人以上</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- 教室列表表格 -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="classroomTable">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 ps-4" style="width: 25%;">教室編號</th>
                                <th class="py-3" style="width: 35%;">教室名稱</th>
                                <th class="py-3" style="width: 20%;">容納人數</th>
                                <th class="py-3 pe-4 text-center" style="width: 20%;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">C101</td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6 me-2"><i class="bi bi-geo-alt"></i></span>E1-101</td>
                                <td><span class="badge bg-info-subtle text-info-emphasis px-3 py-2 fs-6"><i class="bi bi-people me-1"></i>50 人</span></td>
                                <td class="pe-4 text-center">
                                    <a href="reservation_add.php?cid=C101" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-calendar-plus me-1"></i>預約借用
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">C102</td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6 me-2"><i class="bi bi-geo-alt"></i></span>E1-102</td>
                                <td><span class="badge bg-info-subtle text-info-emphasis px-3 py-2 fs-6"><i class="bi bi-people me-1"></i>40 人</span></td>
                                <td class="pe-4 text-center">
                                    <a href="reservation_add.php?cid=C102" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-calendar-plus me-1"></i>預約借用
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">C201</td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6 me-2"><i class="bi bi-geo-alt"></i></span>E2-201</td>
                                <td><span class="badge bg-info-subtle text-info-emphasis px-3 py-2 fs-6"><i class="bi bi-people me-1"></i>80 人</span></td>
                                <td class="pe-4 text-center">
                                    <a href="reservation_add.php?cid=C201" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-calendar-plus me-1"></i>預約借用
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-muted py-3 px-4 d-flex justify-content-between">
                <small>共查詢到 3 間教室資料</small>
                <small class="text-secondary"><i class="bi bi-info-circle me-1"></i>對應 SQL: <code>SELECT * FROM classroom;</code></small>
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
        // 簡易前端搜尋過濾功能
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelector("#classroomTable tbody").rows;
            for (let i = 0; i < rows.length; i++) {
                let firstCol = rows[i].cells[0].textContent.toUpperCase();
                let secondCol = rows[i].cells[1].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
