<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教室借用系統 - 首頁</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', "Microsoft JhengHei", sans-serif; }
        .hero-section { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; padding: 3rem 1rem; border-radius: 0.75rem; }
        .card-feature { transition: transform 0.2s, box-shadow 0.2s; border: none; border-radius: 1rem; }
        .card-feature:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }
        .feature-icon { font-size: 2.5rem; color: #2563eb; }
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
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house me-1"></i>首頁</a></li>
                    <li class="nav-item"><a class="nav-link" href="classroom.php"><i class="bi bi-search me-1"></i>查詢教室</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php"><i class="bi bi-calendar-check me-1"></i>借用紀錄</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation_add.php"><i class="bi bi-plus-circle me-1"></i>新增借用</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation_manage.php"><i class="bi bi-gear me-1"></i>借用管理</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 主體內容 -->
    <div class="container my-5">
        <!-- Hero Banner -->
        <div class="hero-section text-center mb-5 shadow">
            <h1 class="display-5 fw-bold mb-3">教室借用系統</h1>
            <p class="lead mb-4">Classroom Reservation System</p>
            <div class="d-inline-flex gap-2">
                <span class="badge bg-light text-primary px-3 py-2 fs-6">第八組</span>
                <span class="badge bg-light text-dark px-3 py-2 fs-6">組員：石智宇、王傑民</span>
            </div>
        </div>

        <!-- 系統功能快捷區塊 -->
        <h3 class="fw-bold mb-4 text-secondary text-center">系統核心功能</h3>
        <div class="row g-4">
            <!-- 功能 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-feature h-100 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="feature-icon mb-3"><i class="bi bi-door-open"></i></div>
                        <h5 class="card-title fw-bold">查詢教室</h5>
                        <p class="card-text text-muted">即時瀏覽所有教室清單、容納人數與基本資訊。</p>
                        <a href="classroom.php" class="btn btn-outline-primary w-100">前往查詢</a>
                    </div>
                </div>
            </div>

            <!-- 功能 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-feature h-100 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="feature-icon mb-3"><i class="bi bi-card-checklist"></i></div>
                        <h5 class="card-title fw-bold">借用紀錄</h5>
                        <p class="card-text text-muted">查看已借用的教室排程、日期及最新審核狀態。</p>
                        <a href="reservation.php" class="btn btn-outline-primary w-100">查看紀錄</a>
                    </div>
                </div>
            </div>

            <!-- 功能 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-feature h-100 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="feature-icon mb-3"><i class="bi bi-calendar-plus"></i></div>
                        <h5 class="card-title fw-bold">新增借用</h5>
                        <p class="card-text text-muted">選擇欲借用的教室、日期，快速提交借用申請表單。</p>
                        <a href="reservation_add.php" class="btn btn-primary w-100">申請借用</a>
                    </div>
                </div>
            </div>

            <!-- 功能 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-feature h-100 shadow-sm p-3 text-center">
                    <div class="card-body">
                        <div class="feature-icon mb-3"><i class="bi bi-shield-check"></i></div>
                        <h5 class="card-title fw-bold">借用管理</h5>
                        <p class="card-text text-muted">管理員審核借用申請、變更審核狀態或刪除紀錄。</p>
                        <a href="reservation_manage.php" class="btn btn-outline-dark w-100">進入管理</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <footer class="bg-white border-top py-4 mt-5 text-center text-muted">
        <div class="container">
            <p class="mb-0">教室借用系統</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
