namespace restapi3
{
    public class Car
    {
        public Car()
        {
        }

        public string LicensePlate { get; set; }
        public string Make { get; set; }
        public string Model { get; set; }
        public int KW { get; set; }
        public int CCM { get; set; }
        public int KM { get; set; }
        public bool Transmission { get; set; }
        public int PricePerHour { get; set; }
        public int PricePerKm { get; set; }
        public string Category { get; set; }
        public string Type { get; set; }
        public string Status { get; set; }
    }

}
