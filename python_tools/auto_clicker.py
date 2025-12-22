import tkinter as tk
from tkinter import ttk
import pyautogui
import time
import threading

class AutoClickerApp:
    def __init__(self, root):
        self.root = root
        self.root.title("Auto Clicker - Concurrency Test")
        self.root.geometry("350x350")
        self.root.resizable(False, False)

        self.point1 = None
        self.point2 = None

        # Styles
        style = ttk.Style()
        style.configure("TButton", font=("Helvetica", 10), padding=5)
        style.configure("Big.TButton", font=("Helvetica", 12, "bold"), padding=10)

        # UI Elements
        main_frame = ttk.Frame(root, padding="20")
        main_frame.pack(fill=tk.BOTH, expand=True)

        ttk.Label(main_frame, text="Công cụ Click Đồng Thời", font=("Helvetica", 14, "bold")).pack(pady=(0, 15))

        # Point 1 check
        self.lbl_p1 = ttk.Label(main_frame, text="Điểm 1: Chưa chọn", foreground="red")
        self.lbl_p1.pack(pady=2)
        self.btn_p1 = ttk.Button(main_frame, text="Chọn Điểm 1 (Delay 3s)", command=lambda: self.set_point(1))
        self.btn_p1.pack(pady=5)

        # Point 2 check
        self.lbl_p2 = ttk.Label(main_frame, text="Điểm 2: Chưa chọn", foreground="red")
        self.lbl_p2.pack(pady=2)
        self.btn_p2 = ttk.Button(main_frame, text="Chọn Điểm 2 (Delay 3s)", command=lambda: self.set_point(2))
        self.btn_p2.pack(pady=5)

        ttk.Separator(main_frame, orient='horizontal').pack(fill='x', pady=15)

        # Action
        self.btn_run = ttk.Button(main_frame, text="CLICK NGAY!", command=self.run_click, style="Big.TButton", state="disabled")
        self.btn_run.pack(pady=10, fill='x')

        self.status_lbl = ttk.Label(main_frame, text="Trạng thái: Sẵn sàng", font=("Helvetica", 9, "italic"))
        self.status_lbl.pack(pady=5)

        ttk.Label(main_frame, text="Cách dùng: Chọn điểm -> Di chuột đến nút Đăng ký -> Chờ 3s để lưu.").pack(pady=10, side=tk.BOTTOM)


    def set_point(self, point_num):
        # Disable buttons while setting
        self.btn_p1.config(state="disabled")
        self.btn_p2.config(state="disabled")
        self.btn_run.config(state="disabled")

        self.status_lbl.config(text=f"Di chuyển chuột đến BUTTON {point_num}...", foreground="blue")
        self.root.update()
        
        # Countdown
        for i in range(3, 0, -1):
            self.status_lbl.config(text=f"Lấy toạ độ trong {i}s...")
            self.root.update()
            time.sleep(1)

        x, y = pyautogui.position()
        
        if point_num == 1:
            self.point1 = (x, y)
            self.lbl_p1.config(text=f"Điểm 1: ({x}, {y})", foreground="green")
        else:
            self.point2 = (x, y)
            self.lbl_p2.config(text=f"Điểm 2: ({x}, {y})", foreground="green")

        self.status_lbl.config(text=f"Đã lưu điểm {point_num}", foreground="black")

        # Re-enable buttons
        self.btn_p1.config(state="normal")
        self.btn_p2.config(state="normal")
        
        if self.point1 and self.point2:
            self.btn_run.config(state="normal")

    def run_click(self):
        if not self.point1 or not self.point2:
            return

        # Disable run button during countdown
        self.btn_run.config(state="disabled")
        
        # 2-second countdown before clicking
        for i in range(2, 0, -1):
            self.status_lbl.config(text=f"Chuẩn bị click trong {i}s... (Chuyển sang trang test!)", foreground="orange")
            self.root.update()
            time.sleep(1)

        self.status_lbl.config(text="Đang thực hiện click...", foreground="blue")
        self.root.update()

        # Click điểm 1 trước
        pyautogui.click(self.point1[0], self.point1[1])
        
        # Delay nhỏ để tránh bị nhận diện là drag
        time.sleep(0.05)
        
        # Click điểm 2 sau
        pyautogui.click(self.point2[0], self.point2[1])

        self.status_lbl.config(text="Đã click xong cả 2 điểm!", foreground="green")
        self.btn_run.config(state="normal")

if __name__ == "__main__":
    root = tk.Tk()
    # Bring window to front
    root.lift()
    root.attributes('-topmost',True)
    root.after_idle(root.attributes,'-topmost',False)
    
    app = AutoClickerApp(root)
    root.mainloop()
