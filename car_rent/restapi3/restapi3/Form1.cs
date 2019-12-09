using RestSharp;
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
    public partial class Form1 : Form
    {
        private const string URL = "http://localhost/car_rent/api/";
        private const string ROUTE = "index.php";

        public string APIKey { get; private set; }

        public Form1() => this.InitializeComponent();

        private void Form1_Load(object sender, EventArgs e)
        {
        }

        internal void AddCar(string license_plate, string make, string model, string kw, string km, string ccm, bool automatic, string pricePerHour, string pricePerKilometer, string category, string type, string status)
        {
            try
            {
                var client = new RestClient(URL);
                var request = new RestRequest(ROUTE, Method.POST)
                {
                    RequestFormat = DataFormat.Json
                };
                _ = request.AddHeader("car_rent_token", APIKey);
                _ = request.AddBody(new Car
                {
                    LicensePlate = license_plate,
                    Make = make,
                    Model = model,
                    KW = int.Parse(kw),
                    KM = int.Parse(km),
                    CCM = int.Parse(ccm),
                    Transmission = automatic,
                    PricePerHour = int.Parse(pricePerHour),
                    PricePerKm = int.Parse(pricePerKilometer),
                    Category = category,
                    Type = type,
                    Status = status
                });
                var response = client.Execute(request);
                _ = MessageBox.Show(response.StatusDescription, $"{response.StatusCode}: {response.ResponseStatus}");
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }

        internal void EditCar(string license, string license_plate, string make, string model, string kw, string km, string ccm, bool automatic, string pricePerHour, string pricePerKilometer, string category, string type, string status)
        {
            try
            {
                var client = new RestClient(URL);
                var request = new RestRequest(ROUTE, Method.PUT)
                {
                    RequestFormat = DataFormat.Json
                };
                _ = request.AddHeader("car_rent_token", APIKey);
                _ = request.AddHeader("old_license", license);
                _ = request.AddBody(new Car
                {
                    LicensePlate = license_plate,
                    Make = make,
                    Model = model,
                    KW = int.Parse(kw),
                    KM = int.Parse(km),
                    CCM = int.Parse(ccm),
                    Transmission = automatic,
                    PricePerHour = int.Parse(pricePerHour),
                    PricePerKm = int.Parse(pricePerKilometer),
                    Category = category,
                    Type = type,
                    Status = status
                });
                var response = client.Execute(request);
                _ = MessageBox.Show(response.StatusDescription, $"{response.StatusCode}: {response.ResponseStatus}");
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }

        public void LoadButton_clicked(object sender, EventArgs e)
        {
            try
            {
                var client = new RestClient(URL);
                var request = new RestRequest(ROUTE, Method.GET);
                var response = client.Execute<List<Car>>(request);
                dataGridView1.DataSource = response.Data;
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }

        private void Btn_AddKey_click(object sender, EventArgs e)
        {
            var loginForm = new Login(this);
            loginForm.Show();
        }

        public void AddKey(string APIKey)
        {
            this.APIKey = APIKey;
            lbl_userName.Text = "API-Key megadva";
            btn_edit.Enabled = true;
            btn_delete.Enabled = true;
            btn_NewCar.Enabled = true;
        }

        private void Btn_edit_Click(object sender, EventArgs e)
        {
            try
            {
                var client = new RestClient(URL);
                var ROUTE = "index.php" + "?license_plate=" + txt_edit.Text;
                var request = new RestRequest(ROUTE, Method.GET);
                var response = client.Execute<List<Car>>(request);
                if (response.Data.Count == 0)
                {
                    _ = MessageBox.Show("License Plate not found");
                    return;
                }
                var form = new EditCar(this, response.Data[0]);
                form.Show();
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }

        private void btn_delete_Click(object sender, EventArgs e)
        {
            try
            {
                var client = new RestClient(URL);
                var ROUTE = "index.php";
                var request = new RestRequest(ROUTE, Method.DELETE)
                {
                    RequestFormat = DataFormat.Json
                };
                _ = request.AddHeader("car_rent_token", APIKey);
                _ = request.AddHeader("license_plate", txt_del.Text);
                var response = client.Execute(request);
                _ = MessageBox.Show(response.StatusDescription, $"{response.StatusCode}: {response.ResponseStatus}");
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }

        private void Btn_NewClicked(object sender, EventArgs e)
        {
            var form = new NewCar(this);
            form.Show();
        }

        private void DataGridView1_RowEnter(object sender, DataGridViewCellEventArgs e)
        {
            try
            {
                if (dataGridView1.SelectedRows.Count > 0)
                {
                    txt_del.Text = dataGridView1.SelectedRows[0].Cells[0].Value.ToString();
                    txt_edit.Text = txt_del.Text;
                }
            }
            catch (Exception ex)
            {
                _ = MessageBox.Show(ex.Message, "error");
            }
        }
    }
}
