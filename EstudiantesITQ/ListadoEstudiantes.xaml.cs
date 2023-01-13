using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace EstudiantesITQ
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class ListadoEstudiantes : ContentPage


    {

        private const string Url = "http://10.20.23.200/itq/post.php";

        private readonly HttpClient client = new HttpClient();
        private ObservableCollection<Datos> _post;
        public int codigo = -1;
        public string nombre, apellido, correo, telefono;

        public ListadoEstudiantes()
        {
            InitializeComponent();
            Get();

        }

        public async void Get()
        {
            try
            {
                var content = await client.GetStringAsync(Url);
                List<Datos> post = JsonConvert.DeserializeObject<List<Datos>>(content);
                _post = new ObservableCollection<Datos>(post);

                lstViewEstudiantes.ItemsSource = post;
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex);
            }
        }
    }
}