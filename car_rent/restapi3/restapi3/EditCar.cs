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
    public partial class EditCar : Form
    {
        private Form1 form1;
        private Car car;
        public string LicensePlate { get; private set; }

        public EditCar(Form1 form1, Car car)
        {
            this.InitializeComponent();
            this.form1 = form1;
            this.car = car;
            LicensePlate = car.LicensePlate;
        }

        private void btn_send_Click(object sender, EventArgs e)
            => form1.EditCar(LicensePlate, txt_licensePlate.Text, txt_make.Text, txt_model.Text, txt_kw.Text, txt_km.Text, txt_ccm.Text, checkBox1.Checked, txt_pricePerHour.Text, txt_pricePerKilometer.Text, txt_category.Text, txt_type.Text, txt_status.Text);

        private void EditCar_Load(object sender, EventArgs e)
        {
            txt_licensePlate.Text = car.LicensePlate;
            txt_make.Text = car.Make;
            txt_model.Text = car.Model;
            txt_kw.Text = car.KW.ToString();
            txt_km.Text = car.KM.ToString();
            txt_ccm.Text = car.CCM.ToString();
            txt_pricePerHour.Text = car.PricePerHour.ToString();
            txt_pricePerKilometer.Text = car.PricePerKm.ToString();
            txt_category.Text = car.Category;
            txt_type.Text = car.Type;
            txt_status.Text = car.Status;
            checkBox1.Checked = car.Transmission;
        }
    }
}
