<?php
    class Vin_Search {
        /**
         * Plate number of the car
         * 
         * @var string
         */
        private string $plate_number;
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