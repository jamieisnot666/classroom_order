import matplotlib.pyplot as plt
import matplotlib.patches as patches
from matplotlib.path import Path
import numpy as np

# 設定圖形高解析度與中文字型
plt.rcParams['font.sans-serif'] = ['Microsoft JhengHei', 'SimHei', 'Arial Unicode MS', 'sans-serif']
plt.rcParams['axes.unicode_minus'] = False

fig, ax = plt.subplots(figsize=(10, 5.5), dpi=300)
ax.set_facecolor('#ffffff')
fig.patch.set_facecolor('#ffffff')

# 繪製貝茲曲線分支
def draw_branch(x0, y0, x1, y1, color, lw=3.5):
    verts = [
        (x0, y0),
        (x0 + (x1 - x0)*0.55, y0),
        (x0 + (x1 - x0)*0.45, y1),
        (x1, y1)
    ]
    codes = [Path.MOVETO, Path.CURVE4, Path.CURVE4, Path.CURVE4]
    path = Path(verts, codes)
    patch = patches.PathPatch(path, facecolor='none', edgecolor=color, lw=lw, capstyle='round')
    ax.add_patch(patch)

# 定義節點位置
# Root
root_x, root_y = 1.8, 3.0

# Level 1 Nodes
nodes = [
    {"name": "查詢教室\nclassroom.php", "x": 5.2, "y": 4.8, "color": "#0ea5e9", "bg": "#e0f2fe", "text_color": "#0369a1"},
    {"name": "借用紀錄\nreservation.php", "x": 5.2, "y": 3.0, "color": "#8b5cf6", "bg": "#ede9fe", "text_color": "#6d28d9"},
    {"name": "借用管理\nreservation_manage.php", "x": 5.2, "y": 1.2, "color": "#f59e0b", "bg": "#fef3c7", "text_color": "#b45309"},
]

# Level 2 Nodes (Child of reservation.php)
sub_node = {"name": "新增借用\nreservation_add.php", "x": 8.6, "y": 3.0, "color": "#10b981", "bg": "#d1fae5", "text_color": "#047857"}

# 畫分支曲線
# Root -> Level 1
for n in nodes:
    draw_branch(root_x + 1.2, root_y, n["x"] - 1.2, n["y"], n["color"], lw=3.8)

# Level 1 (借用紀錄) -> Level 2 (新增借用)
draw_branch(nodes[1]["x"] + 1.2, nodes[1]["y"], sub_node["x"] - 1.2, sub_node["y"], sub_node["color"], lw=3.5)

# 畫節點方塊
# 根節點 (Root Box)
root_box = patches.FancyBboxPatch(
    (root_x - 1.3, root_y - 0.55), 2.5, 1.1,
    boxstyle="round,pad=0.2,rounding_size=0.25",
    facecolor="#1e293b", edgecolor="#0f172a", lw=1.5
)
ax.add_patch(root_box)
ax.text(root_x - 0.05, root_y + 0.12, "教室借用系統", color="white", fontsize=13, weight="bold", ha="center", va="center")
ax.text(root_x - 0.05, root_y - 0.22, "index.php (首頁)", color="#94a3b8", fontsize=10, ha="center", va="center")

# 一級節點
for n in nodes:
    box = patches.FancyBboxPatch(
        (n["x"] - 1.25, n["y"] - 0.48), 2.5, 0.96,
        boxstyle="round,pad=0.2,rounding_size=0.2",
        facecolor=n["bg"], edgecolor=n["color"], lw=2.2
    )
    ax.add_patch(box)
    lines = n["name"].split("\n")
    ax.text(n["x"], n["y"] + 0.14, lines[0], color=n["text_color"], fontsize=12, weight="bold", ha="center", va="center")
    ax.text(n["x"], n["y"] - 0.18, lines[1], color="#475569", fontsize=9.5, ha="center", va="center")

# 二級子節點
sub_box = patches.FancyBboxPatch(
    (sub_node["x"] - 1.25, sub_node["y"] - 0.48), 2.5, 0.96,
    boxstyle="round,pad=0.2,rounding_size=0.2",
    facecolor=sub_node["bg"], edgecolor=sub_node["color"], lw=2.2
)
ax.add_patch(sub_box)
lines = sub_node["name"].split("\n")
ax.text(sub_node["x"], sub_node["y"] + 0.14, lines[0], color=sub_node["text_color"], fontsize=12, weight="bold", ha="center", va="center")
ax.text(sub_node["x"], sub_node["y"] - 0.18, lines[1], color="#475569", fontsize=9.5, ha="center", va="center")

# 標題與標籤
ax.set_title("教室借用系統 - 網站架構階層樹狀圖 (Site Map)", fontsize=14, weight="bold", pad=20, color="#1e293b")
ax.set_xlim(0, 10.2)
ax.set_ylim(0.2, 5.8)
ax.axis('off')

plt.tight_layout()
plt.savefig(r"C:\Users\USER\Desktop\程式用\資料庫系統\screenshots\sitemap.png", bbox_inches='tight', dpi=300)
print("Sitemap generated successfully!")
