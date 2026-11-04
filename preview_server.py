import http.server
import socketserver
import webbrowser
import os

PORT = 8080
DIRECTORY = os.path.dirname(os.path.abspath(__file__))

class PHPAsHTMLHandler(http.server.SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=DIRECTORY, **kwargs)

    def guess_type(self, path):
        # 將 .php 檔案以 HTML 方式渲染至瀏覽器，方便截圖
        if path.endswith('.php'):
            return 'text/html; charset=utf-8'
        return super().guess_type(path)

if __name__ == '__main__':
    os.chdir(DIRECTORY)
    with socketserver.TCPServer(("", PORT), PHPAsHTMLHandler) as httpd:
        print(f"=====================================================")
        print(f" 教室借用系統 本地預覽伺服器已啟動！")
        print(f" 網址: http://localhost:{PORT}/index.php")
        print(f" 請直接在開啟的瀏覽器中預覽與截圖。")
        print(f" 若要關閉伺服器，請按 Ctrl+C 或關閉此視窗。")
        print(f"=====================================================")
        webbrowser.open(f"http://localhost:{PORT}/index.php")
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            print("\n伺服器已停止。")
