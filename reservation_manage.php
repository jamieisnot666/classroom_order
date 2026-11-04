<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教室借用系統 - 借用管理</title>
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
                    <li class="nav-item"><a class="nav-link" href="reservation_add.php"><i class="bi bi-plus-circle me-1"></i>新增借用</a></li>
                    <li class="nav-item"><a class="nav-link active" href="reservation_manage.php"><i class="bi bi-gear me-1"></i>借用管理</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 主體內容 -->
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1"><i class="bi bi-shield-lock me-2 text-primary"></i>借用管理後台</h3>
                <p class="text-muted mb-0">管理員後台：審核預約借用、修改狀態或刪除借用資料</p>
            </div>
            <span class="badge bg-dark-subtle text-dark border px-3 py-2 fs-6">
                <i class="bi bi-person-badge me-1"></i>管理者身分
            </span>
        </div>

        <!-- 操作提示條 -->
        <div id="actionNotice" class="alert alert-info alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            可直接點選下方 <strong>「核准借用 (UPDATE)」</strong> 變更借用狀態，或點選 <strong>「刪除紀錄 (DELETE)」</strong> 移除資料。
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- 借用管理表格 -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold text-secondary"><i class="bi bi-list-check me-2"></i>所有借用紀錄清單</span>
                <span class="text-muted small">共 3 筆待處理或已建立資料</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="manageTable">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 ps-4" style="width: 8%;">ID</th>
                                <th class="py-3" style="width: 15%;">借用人編號</th>
                                <th class="py-3" style="width: 15%;">教室編號</th>
                                <th class="py-3" style="width: 18%;">借用日期</th>
                                <th class="py-3" style="width: 18%;">目前狀態</th>
                                <th class="py-3 pe-4 text-center" style="width: 26%;">管理操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 紀錄 1 -->
                            <tr id="row-1">
                                <td class="ps-4 fw-bold">1</td>
                                <td><span class="fw-semibold">U001</span> (王小明)</td>
                                <td><span class="badge bg-secondary">C101</span> E1-101</td>
                                <td>2026-11-10</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2" id="status-1">
                                        approved
                                    </span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" onclick="toggleStatus(1)">
                                        <i class="bi bi-pencil me-1"></i>改為 pending
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteRow(1)">
                                        <i class="bi bi-trash me-1"></i>刪除
                                    </button>
                                </td>
                            </tr>
                            <!-- 紀錄 2 -->
                            <tr id="row-2" class="table-warning-subtle">
                                <td class="ps-4 fw-bold">2</td>
                                <td><span class="fw-semibold">U002</span> (陳怡君)</td>
                                <td><span class="badge bg-secondary">C102</span> E1-102</td>
                                <td>2026-11-11</td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2" id="status-2">
                                        pending
                                    </span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-success me-1" onclick="approveRecord(2)">
                                        <i class="bi bi-check-lg me-1"></i>核准 (Approve)
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteRow(2)">
                                        <i class="bi bi-trash me-1"></i>刪除
                                    </button>
                                </td>
                            </tr>
                            <!-- 紀錄 3 -->
                            <tr id="row-3">
                                <td class="ps-4 fw-bold">3</td>
                                <td><span class="fw-semibold">U001</span> (王小明)</td>
                                <td><span class="badge bg-secondary">C201</span> E2-201</td>
                                <td>2026-11-15</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2" id="status-3">
                                        approved
                                    </span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-outline-secondary me-1" onclick="toggleStatus(3)">
                                        <i class="bi bi-pencil me-1"></i>改為 pending
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteRow(3)">
                                        <i class="bi bi-trash me-1"></i>刪除 (DELETE)
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-muted py-3 px-4">
                <div class="d-flex flex-column gap-1">
                    <small><i class="bi bi-check-circle me-1 text-success"></i><strong>更新功能對應 SQL：</strong> <code>UPDATE reservation SET status = 'approved' WHERE reservation_id = 2;</code></small>
                    <small><i class="bi bi-trash me-1 text-danger"></i><strong>刪除功能對應 SQL：</strong> <code>DELETE FROM reservation WHERE reservation_id = 3;</code></small>
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
        // 模擬核准借用狀態
        function approveRecord(id) {
            const statusBadge = document.getElementById('status-' + id);
            statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-2';
            statusBadge.innerText = 'approved';
            document.getElementById('row-' + id).classList.remove('table-warning-subtle');
            alert('已成功將 reservation_id = ' + id + ' 之狀態修改為 approved！\n(執行 UPDATE reservation SET status = \'approved\' WHERE reservation_id = ' + id + ')');
        }

        // 模擬變更狀態
        function toggleStatus(id) {
            const statusBadge = document.getElementById('status-' + id);
            if (statusBadge.innerText === 'approved') {
                statusBadge.className = 'badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2';
                statusBadge.innerText = 'pending';
            } else {
                statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-2';
                statusBadge.innerText = 'approved';
            }
        }

        // 模擬刪除紀錄
        function deleteRow(id) {
            if (confirm('確定要刪除第 ' + id + ' 筆借用紀錄嗎？\n(執行 DELETE FROM reservation WHERE reservation_id = ' + id + ')')) {
                const row = document.getElementById('row-' + id);
                if (row) {
                    row.style.transition = 'all 0.5s';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 500);
                }
            }
        }
    </script>
</body>
</html>
