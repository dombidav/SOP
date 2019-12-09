namespace restapi3
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.dataGridView1 = new System.Windows.Forms.DataGridView();
            this.btn_refresh = new System.Windows.Forms.Button();
            this.btn_addKey = new System.Windows.Forms.Button();
            this.lbl_userName = new System.Windows.Forms.Label();
            this.btn_edit = new System.Windows.Forms.Button();
            this.txt_edit = new System.Windows.Forms.TextBox();
            this.txt_del = new System.Windows.Forms.TextBox();
            this.btn_delete = new System.Windows.Forms.Button();
            this.btn_NewCar = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).BeginInit();
            this.SuspendLayout();
            // 
            // dataGridView1
            // 
            this.dataGridView1.AllowUserToAddRows = false;
            this.dataGridView1.AllowUserToDeleteRows = false;
            this.dataGridView1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView1.Location = new System.Drawing.Point(12, 12);
            this.dataGridView1.Name = "dataGridView1";
            this.dataGridView1.ReadOnly = true;
            this.dataGridView1.Size = new System.Drawing.Size(1110, 313);
            this.dataGridView1.TabIndex = 0;
            this.dataGridView1.RowEnter += new System.Windows.Forms.DataGridViewCellEventHandler(this.DataGridView1_RowEnter);
            // 
            // btn_refresh
            // 
            this.btn_refresh.Location = new System.Drawing.Point(12, 331);
            this.btn_refresh.Name = "btn_refresh";
            this.btn_refresh.Size = new System.Drawing.Size(75, 23);
            this.btn_refresh.TabIndex = 1;
            this.btn_refresh.Text = "Refresh";
            this.btn_refresh.UseVisualStyleBackColor = true;
            this.btn_refresh.Click += new System.EventHandler(this.LoadButton_clicked);
            // 
            // btn_addKey
            // 
            this.btn_addKey.Location = new System.Drawing.Point(93, 331);
            this.btn_addKey.Name = "btn_addKey";
            this.btn_addKey.Size = new System.Drawing.Size(75, 23);
            this.btn_addKey.TabIndex = 2;
            this.btn_addKey.Text = "Login";
            this.btn_addKey.UseVisualStyleBackColor = true;
            this.btn_addKey.Click += new System.EventHandler(this.Btn_AddKey_click);
            // 
            // lbl_userName
            // 
            this.lbl_userName.AutoSize = true;
            this.lbl_userName.Location = new System.Drawing.Point(9, 375);
            this.lbl_userName.Name = "lbl_userName";
            this.lbl_userName.Size = new System.Drawing.Size(107, 13);
            this.lbl_userName.TabIndex = 3;
            this.lbl_userName.Text = "API-KEY not present!";
            // 
            // btn_edit
            // 
            this.btn_edit.Enabled = false;
            this.btn_edit.Location = new System.Drawing.Point(314, 331);
            this.btn_edit.Name = "btn_edit";
            this.btn_edit.Size = new System.Drawing.Size(75, 23);
            this.btn_edit.TabIndex = 4;
            this.btn_edit.Text = "Edit";
            this.btn_edit.UseVisualStyleBackColor = true;
            this.btn_edit.Click += new System.EventHandler(this.Btn_edit_Click);
            // 
            // txt_edit
            // 
            this.txt_edit.Location = new System.Drawing.Point(208, 331);
            this.txt_edit.Name = "txt_edit";
            this.txt_edit.Size = new System.Drawing.Size(100, 20);
            this.txt_edit.TabIndex = 5;
            // 
            // txt_del
            // 
            this.txt_del.Location = new System.Drawing.Point(208, 360);
            this.txt_del.Name = "txt_del";
            this.txt_del.Size = new System.Drawing.Size(100, 20);
            this.txt_del.TabIndex = 7;
            // 
            // btn_delete
            // 
            this.btn_delete.Enabled = false;
            this.btn_delete.Location = new System.Drawing.Point(314, 360);
            this.btn_delete.Name = "btn_delete";
            this.btn_delete.Size = new System.Drawing.Size(75, 23);
            this.btn_delete.TabIndex = 6;
            this.btn_delete.Text = "Delete";
            this.btn_delete.UseVisualStyleBackColor = true;
            this.btn_delete.Click += new System.EventHandler(this.btn_delete_Click);
            // 
            // btn_NewCar
            // 
            this.btn_NewCar.Enabled = false;
            this.btn_NewCar.Location = new System.Drawing.Point(1047, 329);
            this.btn_NewCar.Name = "btn_NewCar";
            this.btn_NewCar.Size = new System.Drawing.Size(75, 23);
            this.btn_NewCar.TabIndex = 8;
            this.btn_NewCar.Text = "Add";
            this.btn_NewCar.UseVisualStyleBackColor = true;
            this.btn_NewCar.Click += new System.EventHandler(this.Btn_NewClicked);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1134, 397);
            this.Controls.Add(this.btn_NewCar);
            this.Controls.Add(this.txt_del);
            this.Controls.Add(this.btn_delete);
            this.Controls.Add(this.txt_edit);
            this.Controls.Add(this.btn_edit);
            this.Controls.Add(this.lbl_userName);
            this.Controls.Add(this.btn_addKey);
            this.Controls.Add(this.btn_refresh);
            this.Controls.Add(this.dataGridView1);
            this.Name = "Form1";
            this.Text = "Client";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.DataGridView dataGridView1;
        private System.Windows.Forms.Button btn_refresh;
        private System.Windows.Forms.Button btn_addKey;
        private System.Windows.Forms.Label lbl_userName;
        private System.Windows.Forms.Button btn_edit;
        private System.Windows.Forms.TextBox txt_edit;
        private System.Windows.Forms.TextBox txt_del;
        private System.Windows.Forms.Button btn_delete;
        private System.Windows.Forms.Button btn_NewCar;
    }
}

