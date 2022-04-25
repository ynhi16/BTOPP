// See https://aka.ms/new-console-template for more information
using System;

namespace BTOPP
{
    class canBo
    {
        public string name
        {
            set; get;
        }

        public int age
        {
            set; get;
        }
        public string gender
        {
            set; get;
        }
        public string address
        {
            set; get;
        }
        public virtual void Nhap()
        {
            Console.Write("Nhap ten: ");
            name = Console.ReadLine();
            Console.Write("Nhap tuoi: ");
            age = Convert.ToInt32(Console.ReadLine());
            Console.Write("Nhap gioi tinh: ");
            gender = Console.ReadLine();
            Console.Write("Nhap dia chi: ");
            address = Console.ReadLine();
        }
        public virtual void HienThi()
        {
            Console.WriteLine("Hien thi thong tin: ");
            Console.WriteLine("Ten: " + name);
            Console.WriteLine("Tuoi: " + age);
            Console.WriteLine("Gioi tinh: " + gender);
            Console.WriteLine("Dia chi: " + address);
        }
    }
    class congNhan : canBo
    {
        private string level;
        public congNhan()
        {
            this.name = name;
            this.address = address;
            this.age = age;
            this.gender = gender;
        }
        public override void Nhap()
        {
            base.Nhap();
            Console.Write("Nhap thong tin cap bac: ");
            level = Console.ReadLine();
        }
        public override void HienThi()
        {
            base.HienThi();
            Console.WriteLine("Cap bac: {0}", level);
        }
    }
    class kySu : canBo
    {
        private string branch;

      
        public override void Nhap()
        {
            base.Nhap(); 
            Console.Write("Nhap thong tin nganh dao tao: ");
            branch = Console.ReadLine();
        }
        public override void HienThi()
        {
            base.HienThi();
            Console.WriteLine("Nganh dao tao: {0}", branch);
        }
    }
    class nhanVien : canBo
    {
        private string task;

        public override void Nhap()
        {
            base.Nhap(); 
            Console.Write("Nhap thong tin cong viec: ");
            task = Console.ReadLine();
        }
        public override void HienThi()
        {
            base.HienThi();
            Console.WriteLine("Cong viec: {0}", task);
        }
    }
    
    internal class Program
    {
        static void Main(string[] args)
        {
            congNhan congNhan = new congNhan();
            congNhan.Nhap();
            congNhan.HienThi();
            kySu kySu = new kySu();
            kySu.Nhap();
            kySu.HienThi();
            nhanVien nhanVien = new nhanVien();
            nhanVien.Nhap();
            nhanVien.HienThi();
        }
    }
}