<?php
    class Vin_Search {
        /**
         * Plate number of the car
         * 
         * @var string
         */
        private string $plate_number;
        /**
         * User Agent for the requests
         * 
         * @var string
         */
        private string $user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4735.62 Safari/537.36";
        /**
         * Setting the car's plate number to get the VIN number
         * 
         * @param string
         * @return void
         */
        public function set_plate(string $plate) {
            $this->plate_number = $plate;
        }
    }
    // declaring the class
    $vin = new Vin_Search;

    // setting setting the car plate number
    $vin->set_plate("NA25");