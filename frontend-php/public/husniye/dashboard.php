<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2933;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin: 6px 0;
            text-decoration: none;
            color: #374151;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #e5e7eb;
        }

        /* Main */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: #ffffff;
            padding: 14px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
        }

        .search {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            width: 250px;
        }

        /* Content */
        .content {
            padding: 20px;
        }

        /* Issue list */
        .issue {
            background: #ffffff;
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .open {
            background: #dbeafe;
            color: #1e40af;
        }

        .inprogress {
            background: #fef3c7;
            color: #92400e;
        }

        .done {
            background: #dcfce7;
            color: #166534;
        }

        button {
            padding: 10px 16px;
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Tracker</h2>
        <a href="#">Dashboard</a>
        <a href="#">Issues</a>
        <a href="#">Projects</a>
        <a href="#">Reports</a>
    </div>

    <!-- Main -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <input class="search" placeholder="Issue ara...">
            <button>+ Yeni Issue</button>
        </div>

        <!-- Content -->
        <div class="content">
            <h3>Issue Listesi</h3>

            <div class="issue">
                <div>
                    <b>#101</b> Login sayfası hatası
                </div>
                <span class="badge open">OPEN</span>
            </div>

            <div class="issue">
                <div>
                    <b>#102</b> Dashboard performans iyileştirmesi
                </div>
                <span class="badge inprogress">IN PROGRESS</span>
            </div>

            <div class="issue">
                <div>
                    <b>#103</b> API response bug
                </div>
                <span class="badge done">DONE</span>
            </div>

        </div>

    </div>

</body>

</html>