using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace EstudiantesITQ
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();

            MainPage = new ListadoEstudiantes();
        }

        protected override void OnStart()
        {
        }

        protected override void OnSleep()
        {
        }

        protected override void OnResume()
        {
        }
    }
}
