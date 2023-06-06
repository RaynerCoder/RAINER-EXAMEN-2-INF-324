using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace INF324_SegundoExamen_P3
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }


        private void button1_Click(object sender, EventArgs e)
        {
            Bitmap bmp;
            openFileDialog1.ShowDialog();
            if (openFileDialog1.FileName != "")
            {
                bmp = new Bitmap(openFileDialog1.FileName);
                pictureBox1.Image = bmp;
            }
        }



        int cR, cG, cB;
        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            int mR, mG, mB;
            mR = 0; mG = 0; mB = 0;
            for (int i = e.X - 5; i < e.X + 5; i++)
            {
                for (int j = e.Y - 5; j < e.Y + 5; j++)
                {
                    c = bmp.GetPixel(i, j);
                    mR = mR + c.R;
                    mG = mG + c.G;
                    mB = mB + c.B;

                }
            }
            mR = mR / 100;
            mG = mG / 100;
            mB = mB / 100;

            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();

            cR = mR;
            cG = mG;
            cB = mB;

            GuardarColor(mR, mG, mB);
        }



        int rojo, verde, azul;
        private void GuardarColor(int r, int g, int b)
        {
            rojo = r;
            verde = g;
            azul = b;
        }




        private void button3_Click(object sender, EventArgs e)
        {

            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            int mmR, mmG, mmB;
            int clR, clG, clB;
            SqlDataReader dr;
            String colorcambio;

            //conexion y consulta
            SqlConnection conexion = new SqlConnection(@"Data Source=CODERAYNER\SQLEXPRESS;Initial Catalog=bdtextura;User ID=usuario;Password=123456");
            String sql = "select * from color";
            SqlCommand cmd = new SqlCommand(sql, conexion);
            cmd.CommandType = CommandType.Text;
            conexion.Open();
            dr = cmd.ExecuteReader();
            while (dr.Read())
            {
                //Recupero los datos de la tabla colores (descipcion,r,g,b,colorHexa) de la base de datos
                cR = dr.GetInt32(1);
                cG = dr.GetInt32(2);
                cB = dr.GetInt32(3);
                colorcambio = dr.GetString(4);
                bmp2 = new Bitmap(bmp.Width, bmp.Height);

                for (int i = 0; i < bmp.Width - 10; i = i + 10)
                {
                    for (int j = 0; j < bmp.Height - 10; j = j + 10)
                    {
                        mmR = 0; mmG = 0; mmB = 0;
                        for (int k = i; k < i + 10; k++)
                        {
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                mmR = mmR + c.R;
                                mmG = mmG + c.G;
                                mmB = mmB + c.B;
                            }
                        }

                        mmR = mmR / 100;
                        mmG = mmG / 100;
                        mmB = mmB / 100;

                        if (((cR - 10 < mmR) && (mmR < cR + 10)) &&
                            ((cG - 10 < mmG) && (mmG < cG + 10)) &&
                            ((cB - 10 < mmB) && (mmB < cB + 10)))
                        {
                            clR = Convert.ToInt32(colorcambio.Substring(0, 2), 16);
                            clG = Convert.ToInt32(colorcambio.Substring(2, 2), 16);
                            clB = Convert.ToInt32(colorcambio.Substring(4, 2), 16);

                            for (int k = i; k < i + 10; k++)
                            {
                                for (int l = j; l < j + 10; l++)
                                {
                                    bmp2.SetPixel(k, l, Color.FromArgb(clR, clG, clB));
                                    //if (colorcambio.Equals("333dff", StringComparison.OrdinalIgnoreCase))   
                                    //bmp2.SetPixel(k, l, Color.FromArgb(c.R, c.G, c.B));
                                }
                            }
                        }
                        else
                        {
                            mmR = 0; mmG = 0; mmB = 0;
                            for (int k = i; k < i + 10; k++)
                            {
                                for (int l = j; l < j + 10; l++)
                                {
                                    c = bmp.GetPixel(k, l);
                                    bmp2.SetPixel(k, l, Color.FromArgb(c.R, c.G, c.B));
                                }
                            }

                        }
                    }
                }
                bmp = bmp2;
            }
            pictureBox2.Image = bmp2;
        }




        private void button2_Click(object sender, EventArgs e)
        {
            SqlConnection conexion = new SqlConnection(@"Data Source=CODERAYNER\SQLEXPRESS;Initial Catalog=bdtextura;User ID=usuario;Password=123456");
            String sql = "insert into color(nombre, rojo_R, verde_G, azul_B, color_hexadecimal) values('" + 
                textBox4.Text + "','" + 
                rojo+ "', '" +
                verde + "','" + 
                azul + "', '" +
                textBox5.Text + "')";
            SqlCommand cmd = new SqlCommand(sql, conexion);
            cmd.CommandType = CommandType.Text;
            conexion.Open();
            cmd.ExecuteNonQuery();
            conexion.Close();
            
        }

        private void label4_Click(object sender, EventArgs e)
        {

        }

        private void label5_Click(object sender, EventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }


    }
}
