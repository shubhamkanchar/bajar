<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            "Andhra Pradesh" => [
                "Visakhapatnam",
                "Vijayawada",
                "Guntur",
                "Nellore",
                "Kurnool",
                "Rajahmundry",
                "Kakinada",
                "Tirupati",
                "Anantapur",
                "Kadapa",
                "Eluru",
                "Ongole",
                "Srikakulam",
                "Machilipatnam",
                "Chittoor"
            ],
            "Arunachal Pradesh" => [
                "Itanagar",
                "Naharlagun",
                "Tawang",
                "Pasighat",
                "Ziro",
                "Roing",
                "Bomdila",
                "Tezu",
                "Aalo"
            ],
            "Assam" => [
                "Guwahati",
                "Silchar",
                "Dibrugarh",
                "Jorhat",
                "Nagaon",
                "Tinsukia",
                "Tezpur",
                "Bongaigaon",
                "Sivasagar",
                "Diphu"
            ],
            "Bihar" => [
                "Patna",
                "Gaya",
                "Bhagalpur",
                "Muzaffarpur",
                "Purnia",
                "Darbhanga",
                "Begusarai",
                "Arrah",
                "Katihar",
                "Munger"
            ],
            "Chhattisgarh" => [
                "Raipur",
                "Bhilai",
                "Bilaspur",
                "Korba",
                "Durg",
                "Raigarh",
                "Jagdalpur",
                "Ambikapur",
                "Dhamtari",
                "Kanker"
            ],
            "Goa" => [
                "Panaji",
                "Margao",
                "Vasco da Gama",
                "Mapusa",
                "Ponda",
                "Sanquelim",
                "Canacona"
            ],
            "Gujarat" => [
                "Ahmedabad",
                "Surat",
                "Vadodara",
                "Rajkot",
                "Bhavnagar",
                "Jamnagar",
                "Junagadh",
                "Gandhinagar",
                "Anand",
                "Nadiad",
                "Mehsana",
                "Navsari",
                "Morbi"
            ],
            "Haryana" => [
                "Gurugram",
                "Faridabad",
                "Panipat",
                "Ambala",
                "Karnal",
                "Hisar",
                "Sonipat",
                "Rohtak",
                "Yamunanagar",
                "Bhiwani",
                "Sirsa"
            ],
            "Himachal Pradesh" => [
                "Shimla",
                "Manali",
                "Dharamshala",
                "Solan",
                "Mandi",
                "Bilaspur",
                "Chamba",
                "Nahan",
                "Hamirpur",
                "Kullu"
            ],
            "Jharkhand" => [
                "Ranchi",
                "Jamshedpur",
                "Dhanbad",
                "Bokaro",
                "Hazaribagh",
                "Deoghar",
                "Giridih",
                "Ramgarh",
                "Medininagar",
                "Chaibasa"
            ],
            "Karnataka" => [
                "Bengaluru",
                "Mysuru",
                "Hubballi",
                "Mangaluru",
                "Belagavi",
                "Davanagere",
                "Shivamogga",
                "Tumakuru",
                "Ballari",
                "Bidar",
                "Hospet",
                "Udupi",
                "Chitradurga"
            ],
            "Kerala" => [
                "Thiruvananthapuram",
                "Kochi",
                "Kozhikode",
                "Thrissur",
                "Kollam",
                "Kannur",
                "Alappuzha",
                "Palakkad",
                "Malappuram",
                "Kottayam",
                "Kasargod"
            ],
            "Madhya Pradesh" => [
                "Bhopal",
                "Indore",
                "Jabalpur",
                "Gwalior",
                "Ujjain",
                "Sagar",
                "Ratlam",
                "Rewa",
                "Satna",
                "Dewas",
                "Chhindwara",
                "Shivpuri"
            ],
            "Maharashtra" => [
                "Mumbai",
                "Pune",
                "Nagpur",
                "Thane",
                "Nashik",
                "Aurangabad",
                "Solapur",
                "Amravati",
                "Kolhapur",
                "Sangli",
                "Jalgaon",
                "Latur",
                "Ahmednagar",
                "Dhule",
                "Nanded"
            ],
            "Odisha" => [
                "Bhubaneswar",
                "Cuttack",
                "Rourkela",
                "Brahmapur",
                "Sambalpur",
                "Puri",
                "Balasore",
                "Baripada",
                "Jeypore",
                "Kendujhar"
            ],
            "Punjab" => [
                "Ludhiana",
                "Amritsar",
                "Jalandhar",
                "Patiala",
                "Bathinda",
                "Hoshiarpur",
                "Mohali",
                "Batala",
                "Pathankot",
                "Moga"
            ],
            "Rajasthan" => [
                "Jaipur",
                "Jodhpur",
                "Udaipur",
                "Kota",
                "Ajmer",
                "Bikaner",
                "Bhilwara",
                "Alwar",
                "Sikar",
                "Sri Ganganagar",
                "Barmer"
            ],
            "Tamil Nadu" => [
                "Chennai",
                "Coimbatore",
                "Madurai",
                "Tiruchirappalli",
                "Salem",
                "Tirunelveli",
                "Vellore",
                "Erode",
                "Thoothukudi",
                "Dindigul",
                "Kancheepuram",
                "Tiruppur"
            ],
            "Uttar Pradesh" => [
                "Lucknow",
                "Kanpur",
                "Varanasi",
                "Agra",
                "Meerut",
                "Ghaziabad",
                "Allahabad",
                "Bareilly",
                "Moradabad",
                "Aligarh",
                "Gorakhpur",
                "Jhansi",
                "Saharanpur"
            ],
            "West Bengal" => [
                "Kolkata",
                "Howrah",
                "Durgapur",
                "Asansol",
                "Siliguri",
                "Malda",
                "Kharagpur",
                "Bardhaman",
                "Darjeeling",
                "Haldia",
                "Serampore",
                "Krishnanagar"
            ]
        ];

        foreach($states as $key => $state){
            $record = State::updateOrCreate(
                ['title' => $key],
                ['title' => $key]
            );

            foreach($state as $city){
                City::updateOrCreate(
                    ['title' => $city],
                    ['title' => $city,'state_id'=>$record->id]
                );
            }
        }
    }
}
