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
    public partial class NewCar : Form
    {
        public Form1 ParentForm { get; set; }
        public NewCar(Form1 parent)
        {
            this.InitializeComponent();
            ParentForm = parent;
        }

        private void btn_send_Click(object sender, EventArgs e) 
            => ParentForm.AddCar(txt_licensePlate.Text, txt_make.Text, txt_model.Text, txt_kw.Text, txt_km.Text, txt_ccm.Text, checkBox1.Checked, txt_pricePerHour.Text, txt_pricePerKilometer.Text, txt_category.Text, txt_type.Text, txt_status.Text);
    }
}
