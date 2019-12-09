using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace restapi3
{
    public partial class Login : Form
    {
        public Login(Form1 form1)
        {
            this.InitializeComponent();
            Parent = form1;
        }

        public Form1 Parent { get; }

        private void Btn_Cancel_click(object sender, EventArgs e) => this.Close();

        private void Btn_Login_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrWhiteSpace(textBox2.Text))
            {
                Parent.AddKey(textBox2.Text.Trim());
                this.Close();
            }
        }

        private void Btn_Get_Click(object sender, EventArgs e) => _ = System.Diagnostics.Process.Start("http://localhost/car_rent/");
    }
}
