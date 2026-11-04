<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教室借用系統 - 借用紀錄</title>
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
                    <li class="nav-item"><a class="nav-link active" href="reservation.php"><i class="bi bi-calendar-check me-1"></i>借用紀錄</a></li>
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
                <h3 class="fw-bold mb-1"><i class="bi bi-calendar-check me-2 text-primary"></i>教室借用紀錄</h3>
                <p class="text-muted mb-0">顯示目前所有登記之借用資料、借用人與審核狀態</p>
            </div>
            <a href="reservation_add.php" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>新增借用申請
            </a>
        </div>

        <!-- 借用紀錄統計卡片 (呼應報告中的 Aggregate Function 統計) -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary-subtle text-primary-emphasis">
                    <div class="card-body py-3 d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-uppercase fw-bold">E1-101 借用次數</small>
                            <h4 class="fw-bold mb-0">1 次</h4>
                        </div>
                        <i class="bi bi-bar-chart-fill fs-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-warning-subtle text-warning-emphasis">
                    <div class="card-body py-3 d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-uppercase fw-bold">E1-102 借用次數</small>
                            <h4 class="fw-bold mb-0">1 次</h4>
                        </div>
                        <i class="bi bi-clock-history fs-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success-subtle text-success-emphasis">
                    <div class="card-body py-3 d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-uppercase fw-bold">E2-201 借用次數</small>
                            <h4 class="fw-bold mb-0">1 次</h4>
                        </div>
                        <i class="bi bi-check-circle-fill fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 借用紀錄表格 (呼應報告第 5 頁) -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 ps-4">編號</th>
                                <th class="py-3">借用人</th>
                                <th class="py-3">教室名稱</th>
                                <th class="py-3">借用日期</th>
                                <th class="py-3 pe-4 text-center">借用狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:32px; height:32px; font-size:14px;">王</div>
                                        <div>
                                            <div class="fw-bold">王小明</div>
                                            <small class="text-muted">U001</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6"><i class="bi bi-door-closed me-1"></i>E1-101</span></td>
                                <td><i class="bi bi-calendar3 me-2 text-muted"></i>2026/11/10</td>
                                <td class="pe-4 text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6">
                                        <i class="bi bi-check2-circle me-1"></i>approved (已核准)
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:32px; height:32px; font-size:14px;">陳</div>
                                        <div>
                                            <div class="fw-bold">陳怡君</div>
                                            <small class="text-muted">U002</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6"><i class="bi bi-door-closed me-1"></i>E1-102</span></td>
                                <td><i class="bi bi-calendar3 me-2 text-muted"></i>2026/11/11</td>
                                <td class="pe-4 text-center">
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 fs-6">
                                        <i class="bi bi-hourglass-split me-1"></i>pending (審核中)
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:32px; height:32px; font-size:14px;">王</div>
                                        <div>
                                            <div class="fw-bold">王小明</div>
                                            <small class="text-muted">U001</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary fs-6"><i class="bi bi-door-closed me-1"></i>E2-201</span></td>
                                <td><i class="bi bi-calendar3 me-2 text-muted"></i>2026/11/15</td>
                                <td class="pe-4 text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6">
                                        <i class="bi bi-check2-circle me-1"></i>approved (已核准)
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-muted py-3 px-4 d-flex justify-content-between">
                <small>共 3 筆借用紀錄</small>
                <small class="text-secondary"><i class="bi bi-info-circle me-1"></i>對應 SQL: <code>SELECT U.user_name, C.classroom_name, R.reservation_date, R.status FROM reservation JOIN ...</code></small>
            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <footer class="bg-white border-top py-4 mt-5 text-center text-muted">
        <div class="container">
            <small>教室借用系統</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
